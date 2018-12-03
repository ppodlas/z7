<?php
include "connDB.php";
if (isset($_POST['loguj'])) {
    $login = ($_POST['login']);
    $haslo = md5(($_POST['haslo']));
    $ip = ($_SERVER['REMOTE_ADDR']);
    $time = date('H:i:s d-m-y', time());

    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
        $browseros = "Internet explorer";
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
        $browseros = "Mozilla Firefox";

    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
        $browseros = "Google Chrome";

    else
        $browseros = "Unknown browser";

    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows') !== FALSE)
        $useros = "Windows";
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Linux') !== FALSE)
        $useros = "Linux";

    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'os') !== FALSE)
        $useros = "MacOS";

    else
        $useros = "Unknown system";


    //sprawdzenie czy to klient
    if (mysqli_num_rows(mysqli_query($polaczenie, "SELECT `name`, `pass` FROM `users` WHERE `name` = '" . $login . "' AND `pass` = '" . $haslo . "';")) > 0) {
        mysqli_query($polaczenie, "INSERT INTO `logi` SET `logtime` = '" . $time . "', `ipaddr` = '" . $ip . "' WHERE `name` = '" . $login . "';");
        $cookie_name = $_POST['login'];
        setcookie('imie', $cookie_name, time() + 3600);
        header("Location: http://ppcloud.pl/zad7/index.php");
    } else echo '<span class="error">Logowanie nie powiodło się. Login lub Hasło jest nieprawidłowe</span>';
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>PODLAS</title>
</head>
<body>
<div class="header">
    <h1>
        Logowanie
    </h1>
</div>
<div class="topnav">
            <a href="/#">Strona główna</a>
            <a href="/zad7/register.php" style="float: right">Register now!</a>
        </div>
<form method="POST" class="content" style="width: 500px;" action="login.php">
    <h3 align="center">Log in</h3>
    <div class="input-group">
        <input type="text" style="width: 300px;height: 38px;margin-left: 80px" name="login" placeholder="Username">
    </div>
    <div class="input-group">
        <input type="password" style="width: 300px;height: 38px;margin-left: 80px" name="haslo" placeholder="Password...">
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn" style="width: 100px" name="loguj">Login</button>
        </div>
    </div>
</form>
</body>
</html>