<?php
include "database.php";

try {
        $sql = "CREATE DATABASE IF NOT EXISTS Camagru;";    
    $con->exec($sql);

    $dsn = "mysql:host=localhost;dbname=Camagru";
    $con = new PDO($dsn, $sql_user, $sql_pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS members (
            user_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(200) NOT NULL,
            img_src VARCHAR(3000) DEFAULT 'none',
            password TEXT NOT NULL,
            hash TEXT NOT NULL,
            active BIT DEFAULT 0 NOT NULL,
            notif BIT DEFAULT 1 NOT NULL);";

    $sql .= "CREATE TABLE IF NOT EXISTS images (
            image_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, 
            image_source VARCHAR(255) NOT NULL,
            user_id INT UNSIGNED NOT NULL);";

    $sql .= "CREATE TABLE IF NOT EXISTS comments (
            user_id INT UNSIGNED NOT NULL,
            image_id INT UNSIGNED NOT NULL,
            comment TEXT NOT NULL);";

     $sql .= "CREATE TABLE IF NOT EXISTS likes (
              likes INT DEFAULT 1,
              user_id INT UNSIGNED NOT NULL, 
              image_id INT NOT NULL);";

    $con->exec($sql);                       
}
catch (PDOexception $err) {
    echo $sql.PHP_EOL.$err->getMessage();
}
?>

