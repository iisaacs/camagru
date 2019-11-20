<html>

<head>
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/sign_style.css">
    <?php
        session_start();

        include_once "functions/member_funct.php";

        $gen_err = "";
        if (isset($_POST["username"]) && isset($_POST["password"]))
        {
            $name = $_POST["username"];
            $pass = $_POST["password"];

            if (empty($name) || empty($pass))
                $gen_err = "Enter all fields.";
            if (!in_members($name, $pass))
                $gen_err = "Name and Password does not match any users.";
            else
            {
                if (!is_active($name))
                    $gen_err = "Account not verified. Check your email.";
                else {
                    //create session variable for user
                    $_SESSION["user"] = $name;
                    header("location: index.php");
                    exit();
                }
            }
        }
    ?>
</head>

<style>
    
    form > a {
        grid-column: inputs;
        color: white;
        margin-left: 50px;
    }

</style>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <div class= "sign" onclick="window.location.href='sign-in.php'"><h1>Sign-in</h1></div>
            <div class= "register" onclick="window.location.href='register.php'"><h1>Register</h1></div>
        </div>
        <form class="sign_form" method="post" action="sign-in.php">
            <span class="error"><?php echo $gen_err; ?></span>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" minlength="6" required/>
            <button type="submit" name="submit" ><h2>CONFIRM</h2></button>
            <a href="forgot_pass.php">Forgot Password?</a>
        </form>
        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>

</html>