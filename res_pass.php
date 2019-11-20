<html>
<head>
    <link rel="stylesheet" href="css/home_style.css"/>
    <link rel="stylesheet" href="css/resPass_style.css"/>

</head>



<body>
    <div class="main">
    <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
    </div>

    <form class="repass_form" method="post" action="sign-in.php">
            <span class="error"><?php echo $gen_err; ?></span>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" minlength="6" required/>
            <label for="conpassword">Confirm Password: </label>
            <input type="password" name="conpassword" id="conpassword" minlength="6" required/>
            <button type="submit" name="submit" ><h2>CONFIRM</h2></button>
        </form>

    <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>
</html>