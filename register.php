<html>
<head>
    <link rel="stylesheet" href="./css/home_style.css"/>
    <link rel="stylesheet" href="./css/reg_style.css"/>
    <?php
        session_start();

        // include create which creates databases and tables if it does not exists.
        include_once "./config/setup.php";
        include_once "./functions/member_funct.php";
       
        $gen_err = "";

        // check if all data is set if it is continue...
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["conpassword"]))
        {
            $name = $_POST["username"];
            $pass = $_POST["password"];
            $email = $_POST["email"];

            preg_match("/[a-z]+/", $pass, $match);
            if($match[0] === $pass)
                $gen_err = "Password can not only contain lowercase letters.";
            else if (in_members($name, $email))
                $gen_err = "Username or email address already used.";
            // if all fields are entered, add user data to 'members' table
            else
            {
                // create hashes for password and unique hash for user
                $hash = hash('whirlpool', rand(-2000, 5000));

                set_data($name, $email, $pass, $hash);
                
                $res = gen_email($name, $email, $hash);
                if ($res)
                    header("Location: index.php?mode=reg_successfull&email=".$email."");
                else
                    echo "NO EMAIL SENT!";
            }
        }
        ?>
</head>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <div class= "sign" onclick="window.location.href='sign-in.php'"><h1>Sign-in</h1></div>
            <div class= "register" onclick="window.location.href='register.php'"><h1>Register</h1></div>
        </div>

        <form class="reg_form" method="post" action="register.php">
            <span class="error"><?php echo $gen_err; ?></span>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required/>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" minlength="6" required/>
            <label for="conpassword">Confirm Password: </label>
            <input type="password" name="conpassword" id="conpassword" required/>
            <button type="submit" name="submit" ><h2>CONFIRM</h2></button>
        </form>

        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>
</html>