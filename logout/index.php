<?php
    include("../settings.php");
    setcookie("user", '', 1);
    setcookie("user", '', 1, '/');
    unset($_COOKIE['user'] );   
    file_get_contents($signout_url);
    header("Location: " .  $signin_url  );
?>