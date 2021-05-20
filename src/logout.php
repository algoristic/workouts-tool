<?php
session_start();
unset($_SESSION);
session_destroy();
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Logout</title>
        <meta http-equiv="refresh" content="0; url=https://workout.algoristic.de/" />
    </head>
    <body>
        <p>This page redirects you automatically to the login. If you do not get redirected, click <a href="https://workout.algoristic.de/">here</a>!</p>
    </body>
</html>
