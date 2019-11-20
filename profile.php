<html>
<head>
    <link rel="stylesheet" href="css/home_style.css"/>
    <link rel="stylesheet" href="css/pro_style.css"/>

    <?php
        session_start();
        include_once "functions/member_funct.php";

        $gen_err = "";

        $con = new PDO("mysql:host=localhost;dbname=Camagru", "root", "colinear");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_SESSION["user"]))
        {
            $curr_name = $_SESSION["user"];
            $mem_data = get_data($curr_name);

            $username = $mem_data["username"];
            $email = $mem_data["email"];
            $hash = $mem_data["hash"];
            $old_pass = $mem_data["password"];
            $curr_name = $_SESSION["user"];
            $notif = $_SESSION["notif"];

            if (isset($_POST["username"]) && isset($_POST["email"]))
            {
                $name = $_POST["username"];
                $email = $_POST["email"];

                if (!isset($_POST["notify"]))
                    $notify = 0;
                else
                    $notify = 1;

                $sql = "UPDATE members
                        SET notif=$notify
                        WHERE hash='$hash';";
                $con->exec($sql);
                

                if (!isset($_POST["password"]))
                {
                    $pass = $_POST["password"];
                    $pass = hash('whirlpool', $pass);
                    $new_pass = $_POST["newpassword"];

                    //Check if current password is actual password... 

                    $prep = $con->prepare(" SELECT password, hash
                                            FROM members
                                            WHERE password='$pass' AND hash='$hash';");
                    $prep->execute();
                    $row = $prep->rowCount();
                    $gen_err = "Your account info has been updated";
                    //If it is, update database with new data.
                    if ($row == 1)
                    {
                        $prep = $con->prepare(" UPDATE members
                                                SET username=:name, email=:email, password=:pass, notif=$notify
                                                WHERE hash='$hash' AND password='$pass';");
                        $prep->bindParam(':name', $name);
                        $prep->bindParam(':email', $email);
                        $prep->bindParam(':pass', hash('whirlpool', $new_pass));
                        $prep->execute();

                        $mem_data = get_data($name);
                        $username = $mem_data["username"];
                        $email = $mem_data["email"];
                        $_SESSION["user"] = $name;
                    }
                    else
                        $gen_err = "Incorrect Password.";
                } 
            } 
        }
        else
        {
            header("Location: gallery.php");
            exit();
        }

    ?>
</head>

<body>
    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <div class= "Logout" onclick="window.location.href='index.php?logout=succ.php'"><h1>Logout</h1></div>
        </div>

        <form class="pro_form" method="post" action="profile.php">
            <span class="error"><h2><?php echo $gen_err; ?></h2></span>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required/>
            <label for="password">Current Password: </label>
            <input type="password" name="password" id="password" minlength="6"/>
            <label for="newpassword">New Password: </label>
            <input type="password" name="newpassword" id="newpassword"/>
            <label for="notify">Email Notify: </label>
            <?php if ($notify == 1) { ?>
                <input type="checkbox" name="notify" id="notify" checked>
            <?php } else { ?>
                <input type="checkbox" name="notify" id="notify">
            <?php } ?>
            <button type="submit" name="submit" ><h2>CONFIRM</h2></button>
        </form>


        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>
</html>