<?php
    $host = 'localhost';
    $dbname = 'song';
    $username = 'micha';
    $password = '12345';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";


    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }

?>