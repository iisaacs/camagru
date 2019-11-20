<?php

$dsn = "mysql:host=localhost";
$sql_user = "root";
$sql_pass = "colinear";


try {
    $con = new PDO($dsn, $sql_user, $sql_pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOexception $err) {
    echo $sql.PHP_EOL.$err->getMessage();
}

?>