<?php

session_start();

include("../config/conexion.php");

if (isset($_POST['login'])) {

    // VERIFICAR RECAPTCHA
    $recaptcha_secret = "6LcTIQUtAAAAAAFavRE_fW2NsDfju7EukQqbtol7";
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    $verify = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret="
        . $recaptcha_secret
        . "&response=" . $recaptcha_response
    );

    $captcha_data = json_decode($verify);

    if (!$captcha_data->success) {
        $error = "Por favor completa el captcha.";
    }

    // CONTINUAR SOLO SI CAPTCHA OK
    if (!isset($error)) {

        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $fila = $resultado->fetch_assoc();

            // VERIFICAR SI ESTÁ BLOQUEADO
            if ($fila['bloqueado_hasta'] != NULL) {

                $ahora = date("Y-m-d H:i:s");

                if ($ahora < $fila['bloqueado_hasta']) {

                    $error = "Cuenta bloqueada hasta "
                        . date("H:i:s", strtotime($fila['bloqueado_hasta']));

                } else {

                    // DESBLOQUEAR CUANDO EL TIEMPO TERMINE
                    $sqlReset = "UPDATE usuarios
                    SET intentos = 0,
                        bloqueado_hasta = NULL
                    WHERE usuario='$usuario'";

                    $conn->query($sqlReset);
                }
            }

            // SI NO HAY ERROR DE BLOQUEO
            if (!isset($error)) {

                if (password_verify($password, $fila['password'])) {

                    // LOGIN CORRECTO
                    $token = md5(rand());

                    $_SESSION['admin'] = $usuario;
                    $_SESSION['token'] = $token;

                    // RESETEAR INTENTOS
                    $sqlReset = "UPDATE usuarios
                    SET intentos = 0,
                        bloqueado_hasta = NULL
                    WHERE usuario='$usuario'";

                    $conn->query($sqlReset);

                    // GUARDAR TOKEN
                    $sqlToken = "UPDATE usuarios
                    SET token='$token'
                    WHERE usuario='$usuario'";

                    $conn->query($sqlToken);

                    header("Location: dashboard.php");
                    exit();

                } else {

                    // CONTRASEÑA INCORRECTA
                    $intentos = $fila['intentos'] + 1;

                    // BLOQUEAR AL LLEGAR A 3
                    if ($intentos >= 3) {

                        $minutos = $fila['tiempo_bloqueo'];

                        $bloqueado_hasta = date(
                            "Y-m-d H:i:s",
                            strtotime("+$minutos minutes")
                        );

                        $nuevoTiempo = $minutos + 5;

                        $sqlBloqueo = "UPDATE usuarios
                        SET intentos = 0,
                            bloqueado_hasta = '$bloqueado_hasta',
                            tiempo_bloqueo = $nuevoTiempo
                        WHERE usuario='$usuario'";

                        $conn->query($sqlBloqueo);

                        $error = "Demasiados intentos. "
                            . "Cuenta bloqueada por "
                            . $minutos
                            . " minutos.";

                    } else {

                        // GUARDAR INTENTOS
                        $sqlIntentos = "UPDATE usuarios
                        SET intentos = $intentos
                        WHERE usuario='$usuario'";

                        $conn->query($sqlIntentos);

                        $restantes = 3 - $intentos;

                        $error = "Contraseña incorrecta. "
                            . "Intentos restantes: "
                            . $restantes;
                    }

                    // RETRASO ANTI FUERZA BRUTA
                    sleep(2);
                }
            }

        } else {

            $error = "Usuario no encontrado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Las Ollitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --color-tierra: #7C4A1E;
            --color-tierra-oscuro: #4E2D0D;
            --color-dorado: #C9882A;
            --color-dorado-claro: #F0C060;
            --color-crema: #FAF5EC;
            --color-crema-oscuro: #EFE6D0;
            --color-texto: #2C1A0A;
            --color-texto-claro: #7A5C3A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Lato', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-tierra-oscuro);
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(201, 136, 42, 0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 20%, rgba(124, 74, 30, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 60% 85%, rgba(30, 12, 3, 0.6) 0%, transparent 50%);
            padding: 2rem;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(-45deg,
                    transparent,
                    transparent 40px,
                    rgba(201, 136, 42, 0.03) 40px,
                    rgba(201, 136, 42, 0.03) 42px);
            pointer-events: none;
        }

        /* ─── CARD LOGIN ─── */
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        /* Enlace volver */
        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            margin-bottom: 1.5rem;
            transition: color 0.2s;
        }

        .btn-volver:hover {
            color: var(--color-dorado);
        }

        .login-card {
            background: #fff;
            border-radius: 3px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
        }

        /* Cabecera dorada */
        .login-header {
            background-color: var(--color-tierra-oscuro);
            background-image:
                radial-gradient(ellipse at 70% 30%, rgba(201, 136, 42, 0.25) 0%, transparent 60%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            border-bottom: 3px solid var(--color-dorado);
        }

        .login-logo-ring {
            width: 64px;
            height: 64px;
            border: 2px solid rgba(201, 136, 42, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 1.8rem;
        }

        .login-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--color-dorado-claro);
            letter-spacing: 1px;
            margin-bottom: 0.2rem;
        }

        .login-brand span {
            color: #fff;
            font-weight: 300;
        }

        .login-eyebrow {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(201, 136, 42, 0.6);
        }

        /* Cuerpo del formulario */
        .login-body {
            padding: 2.2rem 2rem 2.5rem;
            background: #fff;
        }

        .login-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.3rem;
        }

        .login-subtitulo {
            font-size: 0.78rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin-bottom: 1.8rem;
        }

        /* Alerta de error */
        .alerta-error {
            background: #fef2f2;
            border: 1px solid rgba(180, 30, 20, 0.2);
            border-left: 4px solid #B91C1C;
            border-radius: 2px;
            padding: 0.8rem 1rem;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.83rem;
            font-weight: 600;
            color: #B91C1C;
        }

        /* Inputs */
        .form-label-custom {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            display: block;
            margin-bottom: 5px;
        }

        .form-control-custom {
            width: 100%;
            background: var(--color-crema);
            border: 1px solid rgba(124, 74, 30, 0.2);
            border-radius: 2px;
            padding: 0.75rem 0.9rem;
            font-family: 'Lato', sans-serif;
            font-size: 0.92rem;
            color: var(--color-texto);
            outline: none;
            transition: border-color 0.2s, background 0.2s;
            margin-bottom: 1.2rem;
        }

        .form-control-custom:focus {
            border-color: var(--color-dorado);
            background: #fff;
        }

        /* Botón */
        .btn-login {
            width: 100%;
            background: var(--color-tierra-oscuro);
            border: none;
            color: var(--color-dorado-claro);
            font-family: 'Lato', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 0.9rem;
            border-radius: 2px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.3rem;
        }

        .btn-login:hover {
            background: var(--color-tierra);
            transform: translateY(-2px);
        }

        /* Separador inferior */
        .login-footer-note {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.72rem;
            color: rgba(124, 74, 30, 0.45);
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- Volver -->
        <a href="../index.php" class="btn-volver">← Volver al Inicio</a>

        <div class="login-card">

            <!-- Cabecera -->
            <div class="login-header">
                <div class="login-logo-ring">🍲</div>
                <h1 class="login-brand">Las <span>Ollitas</span></h1>
                <p class="login-eyebrow">Panel de Administración</p>
            </div>

            <!-- Formulario -->
            <div class="login-body">
                <h2 class="login-titulo">Iniciar Sesión</h2>
                <p class="login-subtitulo">Ingresa tus credenciales para continuar</p>

                <?php if (isset($error)) { ?>
                    <div class="alerta-error">
                        ⚠️ &nbsp;<?php echo $error; ?>
                    </div>
                <?php } ?>

                <form method="POST">

                    <label class="form-label-custom">Usuario</label>
                    <input type="text" name="usuario" class="form-control-custom" placeholder="Tu nombre de usuario"
                        required>

                    <label class="form-label-custom">Contraseña</label>
                    <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
                    <div class="g-recaptcha" data-sitekey="6LcTIQUtAAAAAI9mPu1kMT5HW-q5W4P859zMBPl0"></div>
                    <br>
                    <button type="submit" name="login" class="btn-login">
                        Ingresar al Panel
                    </button>

                </form>

                <p class="login-footer-note">© 2026 Restaurante Las Ollitas</p>
            </div>

        </div>
    </div>

</body>

</html>