<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_crud';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
    } catch (PDOException $e) {
        die('La conexión no se pudo establecer.'.$e->getMessage());
    }

?>