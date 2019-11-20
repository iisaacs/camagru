<?php

function is_active($user)
{
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");

    $sql = "SELECT username, active
            FROM members
            WHERE (username='$user') AND (active=1);";
    $prep = $con->prepare($sql);
    $prep->execute();
    $rows = $prep->rowCount();

    if ($rows == 1)
        return (TRUE);
    return (FALSE);
}

function set_active($email)
{
    try {
        $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");

        $sql = "UPDATE members
                SET active=1
                WHERE (email='$email');";
        $prep = $con->prepare($sql);
        $prep->execute();
    }
    catch(PDOexception $err) {
        echo $sql."error: ".$err->getMessage();
    }
}

function check_hash($hash, $email)
{
    try {
        $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT email, `hash`
                FROM members
                WHERE (email='$email') AND (hash='$hash');";
        $prep = $con->prepare($sql);
        $prep->execute();
        $rows = $prep->rowCount();

        if ($rows != 0)
            return (TRUE);
        return (FALSE);
    }
    catch(PDOexception $err) {
        echo PHP_EOL.$err->getMessage();
    }
}

function in_members($name, $email)
{
    $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");

    $sql = "SELECT username, email
            FROM members
            WHERE (username='$name') OR (email='$email');";

    $prep = $con->prepare($sql);
    $prep->execute();

    $rows = $prep->rowCount();
    if ($rows == 1)
    {
        $con = NULL;
        return (TRUE);
    }
    else
    {
        $con = NULL;
        return (FALSE);
    }
}

function gen_email($name, $email, $hash)
{
    $subject = "Account verification for Camagru";

    $message = "
    Hi ".$name."
     
    Thank you for creating an account with Camagru.

    To finalize your account creation, click on the link below to verify your account.
    
    http://localhost:8080/my_camagru/new_camagru/index.php?email=".$email."&hash=".$hash."
    ";

    $result = mail($email, $subject, $message, "From: noreply@camagru.com");

    return ($result);
}

function set_data($name, $email, $pass, $hash)
{
    try {
        $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $inj_pro = $con->prepare("INSERT INTO members (username, email, password, hash)
                                VALUES (:name, :email, :pass, :hash);");
        $inj_pro->bindParam(':name', $name);
        $inj_pro->bindParam(':email', $email);
        $inj_pro->bindParam(':pass', hash('whirlpool', $pass));
        $inj_pro->bindParam(':hash', $hash);
        $inj_pro->execute();
    }
    catch(PDOexception $err) {
        echo PHP_EOL.$err->getMessage();
    }
}

function get_data($name)
{
        $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $prep = $con->prepare(" SELECT user_id, username, email, hash, notif
                                FROM members
                                WHERE username='$name' OR email='$name';");
        $prep->execute();
        $data = $prep->fetch(PDO::FETCH_ASSOC);
        return ($data);
}
?>