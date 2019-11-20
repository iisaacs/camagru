<html>

<head>
    <link rel="stylesheet" href="css/home_style.css"/>
    <link rel="stylesheet" href="css/comm_style.css"/>
    <?php
        session_start();
        include_once "functions/likeComm_funct.php";
    
        $address = $_SERVER['REQUEST_URI'];
        $user = $_SESSION["user"];
        $pic = $_GET["image"];


        if(isset($_POST["comment"]))
        {
            $msg = $_POST["comment"];
            if ($msg == "")
                header("Location: ".$address);
            else
                // add_msg($user, $msg, $pic);
                get_comments($pic);
        }

        if (!isset($_GET["image"])) {
            header("Location: index.php");
            exit();
        }
        if(isset($_POST["like"]))
           upd_like($_GET["image"], $user);
        $no_likes = get_likes($_GET["image"]);
    ?>

</head>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <div class= "log-out" onclick="window.location.href='index.php?logout=TRUE'"><h1>Logout</h1></div>
            <div class= "profile" onclick="window.location.href='profile.php'"><h1>Profile</h1></div>
        </div>

        <div class="like_pic">
            <img class="pic" src='<?php echo $pic; ?>' />

        <?php if (isset($_SESSION["user"])) { ?>
            <form action="<?php echo $address; ?>" method="post">
                <input class="like_butt" type="submit" name="like" value="LIKE"/>
        <?php } ?>


        <div class="likes"><h1>Likes: <?php echo $no_likes; ?></h1></div>
        </div>

        <div class="comments">

            <form action="<?php echo $address; ?>" method="post">
                <textarea class="mycomm" name="comment" placeholder="Write message here."></textarea>
                <input class="send" type="submit" value="SEND"/>

            <div class="msges">
                <span></span>
            </div>

        </div>

        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>
</html>