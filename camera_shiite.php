<html>

<head>
    <link rel="stylesheet" href="css/home_style.css"/>
    <link rel="stylesheet" href="css/cam_style.css"/>

</head>
<body>

    <div class="main">
        <div class="header">
            <a href="index.php"><img class="logo_div" src="logo.png" alt="camagru_logo"/></a>
            <div class= "gallery" onclick="window.location.href='gallery.php?page=1'"><h1>Gallery</h1></div>
            <div class= "log-out" onclick="window.location.href='index.php?logout=TRUE'"><h1>Logout</h1></div>
            <div class= "profile" onclick="window.location.href='profile.php'"><h1>Profile</h1></div>
        </div>

        <video class="cam" id="video" playsinline autoplay></video>

        <button class="butts" id="snap">capture</button>

        <div class="snaps">
            <canvas style="background-color: grey; border-radius: 10px;" id="canvas" width="600" height="420"></canvas>
        </div>

        <script>

            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const snap = document.getElementById('snap');
            const errorMsgElement = document.getElementById('span#ErrorMsg');
            const res = 
            {
                video:
                {
                    width: 600, height: 420
                }
            };

            async function load_cam ()
            {
                const stream = await navigator.mediaDevices.getUserMedia(res);
                video.srcObject = stream;
            }

            load_cam()
            
            var context = canvas.getContext('2d');
            snap.addEventListener("click", function()
            {
                context.drawImage(video, 0, 0, 600, 420);
            });
        </script>

        <div class="footer">
            <hr>
            <pre>&copy;iisaacs  2019  </pre>
        </div>
    </div>
</body>






</html>