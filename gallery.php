<html>
<head>
    <link rel="stylesheet" href="./css/home_style.css"/>
    <link rel="stylesheet" href="./css/gallery_style.css"/>

    <?php
        session_start();
        include_once "./functions/picture_funct.php";
  
        // add_image("pics/image1.jpeg", 1, "2019/05/10");
        // add_image("pics/image2.jpg", 1, "2019/05/10");
        // add_image("pics/image3.jpeg", 1, "2019/05/10");
        // add_image("pics/image4.png", 1, "2019/05/10");
        // add_image("pics/image5.png", 1, "2019/05/10");
        // add_image("pics/image6.jpeg", 1, "2019/05/10");


        $images = get_images();
        $img_count = count($images);
        $max_pages = ceil(floatval($img_count/6));
        $i = 0;

        if (!isset($_GET["page"]))
        {
            header("Location: index.php");
            exit();
        }

        $page = $_GET["page"];
        $i = ($page * 6) - 6;
    ?>
</head>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <?php if (isset($_SESSION["user"])) { ?>
                <div class= "upload" onclick="window.location.href='camera_shiite.php'"><h1>Upload Image</h1></div>
                <div class= "log-out" onclick="window.location.href='index.php?logout=TRUE'"><h1>Logout</h1></div>
                <div class= "profile" onclick="window.location.href='profile.php'"><h1>Profile</h1></div>
            <?php } 
             else { ?>
                <div class= "sign" onclick="window.location.href='sign-in.php'"><h1>Sign-in</h1></div>
                <div class= "register" onclick="window.location.href='register.php'"><h1>Register</h1></div>
            <?php } ?>
        </div>

    <?php if ($img_count != 0)  { ?>
        <div class="gall">
            <?php $count = 0;
            while ($count < 6 && in_array($images[$i], $images)) {
                $loc = "like_comm.php?image=".$images[$i]; ?>
                <img class="pic" alt="this_is_not_a_picture" onclick="window.location.href='<?php echo $loc; ?>'" src='<?php echo $images[$i]; ?>'/>
            <?php $count++; $i++; } ?>
        </div>

        <?php if ($_GET["page"] != 1) { ?>
            <div class="prev" onclick="<?php $page = $_GET["page"]-1; 
                $loc="gallery.php?page=".$page; ?>window.location.href='<?php echo $loc; ?>'"><h1>PREV</h1></div>
        <?php }

         if ($_GET["page"] != $max_pages) { ?>
            <div class="next" onclick="<?php $page = $_GET["page"]+1; 
                $loc="gallery.php?page=".$page; ?>window.location.href='<?php echo $loc; ?>'"><h1>NEXT</h1></div>
        <?php }
    } else { ?>
        <span style="grid-area: pictures; color: white;"><h1>THERE ARE NO PICTURES IN THE GALLERY</h1></span>
        <?php } ?>

        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>
</html>