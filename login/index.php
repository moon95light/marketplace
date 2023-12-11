<?php
    include("../settings.php");
    setcookie("user", '', 1);
    setcookie("user", '', 1, '/');
    unset($_COOKIE['user'] );
    
    //echo  $signin_url;
    header("Location: " .  $signin_url  );
?>