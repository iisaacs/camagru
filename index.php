<html>
<head>
    <link rel="stylesheet" href="./css/home_style.css"/>
    <link rel="stylesheet" href="./css/pro_style.css"/>

    <?php
        session_start();

        include_once "config/database.php";
        include_once "config/setup.php";
        include_once "functions/member_funct.php";

        $gen_err = "Welcome to Camagru a social 
        network as well as a photo sharing website.";

        if (isset($_SESSION["user"]))
            $gen_err = "Welcome ".$_SESSION["user"]." to Camagru.";
        if (isset($_GET["logout"]))
        {
            unset($_SESSION["user"]);
            $gen_err = "Successfully logged out.";
        }
        if (isset($_GET["email"]) && isset($_GET["hash"]))
        {
            $hash = $_GET["hash"];
            $email = $_GET["email"];

            if (check_hash($hash, $email))
            {
                set_active($email);
                $gen_err = "Your account has successfully been verified. You can log in now.";
            }
            else{
                $gen_err = "Email and Hash are not valid.";
            }
        }

        if (isset($_GET["res_pass"]) && isset($_GET["email"]))
                $gen_err = "A link has been sent to your email. Click on link to reset password.";

        if (isset($_GET["mode"]) && isset($_GET["email"]))
        {
            $mode = $_GET["mode"];
            $email = $_GET["email"];

            $name = "123";

            if (in_members($name, $email) && $mode == "reg_successfull")
            {
                $gen_err = "Registration successfull. A link has been sent to your email. Click on the link to
                            verify your account.";
            }        
        }
    ?>
</head>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <?php  if (isset($_SESSION["user"])) { ?>
                <div class="logout" onclick="window.location.href='index.php?logout=succ.php'"><h1>Logout</h1></div>
                <div class= "profile" onclick="window.location.href='profile.php'"><h1>Profile</h1></div>
            <?php } ?>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <?php if (!isset($_SESSION["user"])) { ?>
                <div class= "sign" onclick="window.location.href='sign-in.php'"><h1>Sign-in</h1></div>
                <div class= "register" onclick="window.location.href='register.php'"><h1>Register</h1></div>
            <?php } ?>
        </div>
        <span class="message">
           <h2 style="color: white;"><?php echo $gen_err;  ?></h2>
    </span>
        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019   </pre>
        </div>
     </div>

</body>
</html>