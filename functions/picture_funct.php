<?php

function get_images() {

    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT image_source
            FROM images;";
    $prep = $con->prepare($sql);
    $prep->execute();

    $res = $prep->fetchAll(PDO::FETCH_COLUMN);
    return ($res);
}

function add_image($img_src, $user_id)
{
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO images (image_source, user_id)
            VALUES ('$img_src', '$user_id');";
    $con->exec($sql); 
}
?>