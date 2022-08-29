<?php
    session_start();

    require 'db.php';

    if (isset($_SESSION['user_id'])) {
        $record = $conn->prepare('SELECT user_id, user_name, user_pwd FROM users WHERE user_id = :id');
        $record->bindParam(':id', $_SESSION['user_id']);
        $record->execute();
        $consult = $record->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (is_countable($consult) > 0) {
            $user = $consult;
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido!</title>
</head>
<body>

    <header>
        <a href="/php_crud">INICIO</a>
    </header>

    <?php if(!empty($user)): ?>
        <br>Hola <?= $user['user_name'] ?>!
        <br>Tu sesión esta iniciada correctamente.
        <a href="logout.php">Cerrar sesión.</a>
    <?php else: ?>
        <h1>Regístrese o inicie sesión.</h1>
        <a href="login.php">Iniciar sesión</a> o
        <a href="signup.php">Registrarse</a>
    <?php endif; ?>
    
</body>
</html>