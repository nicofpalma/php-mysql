<?php
    require 'db.php';

    $message = '';

    if (!empty($_POST['nombreusuario']) && !empty($_POST['contrasena'])) {
        $sql = "INSERT INTO users (user_name, user_pwd) VALUES (:nombreusuario, :contrasena)";
        $prp = $conn->prepare($sql);
        $prp->bindParam(':nombreusuario', $_POST['nombreusuario']);
        $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $prp->bindParam(':contrasena', $password);

        if ($prp->execute()) {
            $message = 'Se registró correctamente.';
        } else {
            $message = 'Hubo un problema al registrar su cuenta.';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>
<body>
    <header>
        <a href="/php_crud">INICIO</a>
    </header>
    
    <?php if(!empty($message)):  ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <form action="signup.php" method="post">
        <input type="text" name="nombreusuario" placeholder="Nombre de usuario">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <input type="submit" value="Confirmar">
    </form>


</body>
</html>