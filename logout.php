<?php
setcookie("imie","",time()-3600);
unset($_COOKIE['imie']);
header("Location: /zad7/login.php");
?>