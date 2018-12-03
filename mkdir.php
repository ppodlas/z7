<?php
$user=$_COOKIE['imie'];
$dirname=$_POST['dirname'];
mkdir("../zad7/Users/$user/$dirname", 0777);
header("Location: index.php");
?>