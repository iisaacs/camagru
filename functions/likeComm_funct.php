<?php

include_once "functions/member_funct.php";

function get_pic_id($pic)
{
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT image_id, image_source
            FROM images
            WHERE image_source='$pic';";
    $prep = $con->prepare($sql);
    $prep->execute();

    $res = $prep->fetch(PDO::FETCH_ASSOC);
    return ($res["image_id"]);
}

function get_likes($pic)
{
    $img_id = get_pic_id($pic);
    $rows = 0;

    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $prep = $con->prepare("SELECT image_id
                FROM likes
                WHERE '$img_id'=image_id;");
    $prep->execute();
    $rows = $prep->rowCount();
    return ($rows);
}

function upd_like($pic, $user)
{

    $img_id = get_pic_id($pic);
    $user_data = get_data($user);
    $user_id = $user_data["user_id"];

    // echo "img_id: ".$img_id." u_id: ".$user_id; 

    //if the image id don't exist in the 'like' database...
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $prep = $con->prepare("SELECT image_id, user_id
                            FROM likes
                            WHERE '$img_id'=image_id AND '$user_id'=user_id;");
    $prep->execute();
    $row = $prep->rowCount();
    // echo $row;

    //create it...
    if ($row == 0)
    {
        $prep = $con->prepare("INSERT INTO likes (user_id, image_id)
                                VALUES ('$user_id', '$img_id');");
        $prep->execute();
        return (TRUE);
    }
    else
    {
        //remove like stuff.
        $con->exec("DELETE FROM likes
                    WHERE image_id='$img_id' AND user_id='$user_id';");
        return (FALSE);
    }
}

function add_msg($user, $msg, $pic){

    $user_data = get_data($user);
    $user_id = $user_data["user_id"];
    $img_id = get_pic_id($pic);


    try {
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $prep = $con->prepare("INSERT INTO comments (user_id, image_id, comment)
                            VAlUES (:user_id, :img_id, :comment);");
    $prep->bindParam(':user_id', $user_id);
    $prep->bindParam(':img_id', $img_id);
    $prep->bindParam(':comment', $msg);
    $prep->execute();
    }
    catch(PDOexception $err) {
        echo PHP_EOL.$err->getMessage();
    }
    
}

function get_comments($pic)
{
 
    $img_id = get_pic_id($pic);

    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $prep = $con->prepare("SELECT comment, image_id
                            FROM comments
                            WHERE image_id='$img_id';");
    $prep->execute();
    $res = $prep->fetchAll(PDO::FETCH_COLUMN);
    return ($res);
}
?>