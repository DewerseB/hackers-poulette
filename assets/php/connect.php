<?php
    try {
        $pdo = new PDO('pgsql:host=ec2-54-75-244-161.eu-west-1.compute.amazonaws.com;port=5432;dbname=d8vbo7hfigkf6a', 'eesbjclxyfomkb', '27349b714d67fec7bb1b060cef30b47ce590253b0b36260ed920455262503560');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Success';
    }
    catch (PDOException $e) {
        die('Erreur : '.$e->getMessage());
    }
?>