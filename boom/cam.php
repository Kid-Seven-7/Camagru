<?php

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_GET['user']) && $_GET['user'] == "back")
{
    echo ("<script>alert('Welcome back');</script>");
}
else if (isset($_SESSION['username']) && isset($_SESSION['email']))
{
    echo ("<script>alert('Logged in successfully');</script>");
}
else
{
    header("Location: index.php?user=res");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="booth">
            <video id="video" width="400" height="300"></video>
            <a href="#" id="capture" class="take">Take Photo!</a>
        </div>
        <div class="boot1">
            <canvas id="canvas" width="400" height="300"></canvas>
        </div>
        <script>
            (function()
            {
                var video = document.getElementById('video'),
                canvas = document.getElementById('canvas'),
                context = canvas.getContext('2d');
                vendorUrl = window.URL || window.webkitURL;
                
                navigator.getMedia = navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia;
                navigator.getMedia({
                    video: true,
                    audio: false
                }, function (stream) {
                    video.src = vendorUrl.createObjectURL(stream);
                    video.play();
                }, function (error) {
                    //I will display an error
                });
                
                document.getElementById('capture').addEventListener('click', function() {
                    context.drawImage(video, 0, 0, 400, 300);
                    var raw = canvas.toDataURL("image/png");
                    document.getElementById('hidden_data').value = raw;
                    var fd = new FormData(document.forms["form1"]);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'config/upload_data.php', true);
                    xhr.send(fd);
                    window.location.href = "localhost:8080/boom/cam.php";
                });
            })();
            </script>
            <form method="POST" accept-charset="utf-8" name="form1">
                <input name="hidden_data" id="hidden_data" type="hidden"/>
                </form>
            </body>
            </html>