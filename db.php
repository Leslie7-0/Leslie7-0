<?php
    $pdo = new PDO('mysql:host=localhost;dbname=authentification','root','');
    $pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>