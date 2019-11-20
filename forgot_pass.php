<html>
<head>
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/forpass_style.css">

    <?php
        include_once "functions/member_funct.php";

        if (isset($_POST["username"]))
        {
            $name = $_POST["username"];
            if (in_members($name, $name))
            {

                $mem_data = get_data($name);
                echo count($mem_data);

                $name = $mem_data["username"];
                $email = $mem_data["email"];
                $hash = $mem_data["hash"];

                $subject = "Forgot password";
                $message = "
                Hi 
                
                It seems you have forgotten your password.
                Click on link below to reset password.

                http://localhost:8080/my_camagru/new_camagru/res_pass.php?name=".$name."&hash=".$hash;

                mail($email, $subject, $message, "From: noreply@camagru.com");
                header("Location: index.php?res_pass=TRUE?email=".$email);
                exit();
            }
        }
    ?>

</head>


<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php'"><h1>Gallery</h1></div>
            <div class= "sign" onclick="window.location.href='sign-in.php'"><h1>Sign-in</h1></div>
            <div class= "register" onclick="window.location.href='register.php'"><h1>Register</h1></div>
        </div>

        <form class="forpass_form" method="post" action="forgot_pass.php">
            <span class="error"><h2><?php echo $gen_err; ?></h2></span>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" placeholder="username/email" required>
            <button class="confirm" type="submit" name="submit"><h2>CONFIRM</h2></button>
        </form>
        

        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>


</body>
</html>