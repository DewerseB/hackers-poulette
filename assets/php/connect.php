<?php
    try {
        $pdo = new PDO('mysql:host=localhost;port=3307;dbname=weatherapp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connection succeeded<br><br>';
    }
    catch (PDOException $e) {
        die('Erreur : '.$e->getMessage());
    }
?>