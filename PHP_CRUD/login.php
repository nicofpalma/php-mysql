<?php

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /php_crud');
    }

    require 'db.php';

    if(!empty($_POST['nombreusuario']) && !empty($_POST['contrasena'])) {
        $record = $conn->prepare('SELECT user_id, user_name, user_pwd FROM users WHERE user_name=:nombreusuario');
        $record->bindParam(':nombreusuario', $_POST['nombreusuario']);
        $record->execute();
        $consult = $record->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (is_countable($consult) > 0 && password_verify($_POST['contrasena'], $consult['user_pwd'])) {
            $_SESSION['user_id'] = $consult['user_id'];
            header('Location: /php_crud');
        } else {
            $message = 'El usuario y contraseña no coincide.';
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>

    <header>
        <a href="/php_crud">INICIO</a>
    </header>

    <h1>Iniciar Sesión</h1>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p> 
    <?php endif;?>

    <form action="login.php" method="post">
        <input type="text" name="nombreusuario" placeholder="Nombre de usuario">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <input type="submit" value="Confirmar">
    </form>
    
</body>
</html>