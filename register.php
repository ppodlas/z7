<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>PODLAS</title>

    <script type="text/javascript">
        <!--
        function redirect() {
            window.location = '/zad7/login.php'

        }

        //-->
    </script>
</head>
<body>
<div class="header">
    <h1>
        Rejestracja
    </h1>
</div>
<div class="topnav">
    <a href="/#">Strona główna</a>
</div>

<form method="POST" class="content" style="width: 500px;" action="register.php">
    <h3 align="center">Register</h3>
    <div class="input-group">
        <input type="text" name="login" style="width: 300px;height: 38px;margin-left: 80px" placeholder="Username...">
    </div>
    <div class="input-group">
        <input type="password" name="haslo1" style="width: 300px;height: 38px;margin-left: 80px" placeholder="Password...">
    </div>
    <div class="input-group">
        <input type="password" name="haslo2" style="width: 300px;height: 38px;margin-left: 80px" placeholder="Repeat Password...">
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn" style="width: 100px" name="rejestruj">Register</button>
        </div>
        <div class="col">
            <font size="3">Have an account?</font>
            <button type="button" class="btn" style="width: 70px" name="zaloguj" onclick="redirect()">Log in</button>
        </div>
    </div>
</form>

<?php

include "connDB.php";


if (isset($_POST['rejestruj'])) {
    $login = ($_POST['login']);
    $haslo1 = md5($_POST['haslo1']);
    $haslo2 = md5($_POST['haslo2']);
    $ip = ($_SERVER['REMOTE_ADDR']);
    $time = date('H:i:s d-m-y', time());

    if (mysqli_num_rows(mysqli_query($polaczenie, "SELECT `name` FROM `users` WHERE `name` = '" . $login . "';")) == 0) {
        if ($haslo1 == $haslo2) // sprawdzamy czy hasła takie same
        {
            mysqli_query($polaczenie, "INSERT INTO `users` (`name`,`pass`)
            VALUES ('" . $login . "', '" . $haslo1 . "');");
            mysqli_query($polaczenie, "INSERT INTO `logi` (`name`,`regtime`,`ipaddr`)
            VALUES ('" . $login . "','" . $time . "', '" . $ip . "');");

            mkdir("Users/$login", 0777);

            echo '<span class="success">Konto zostało utworzone!</span>';

        } else echo '<span class="error">Hasła nie są takie same</span>';

    } else echo '<span class="error">Podany login jest już zajęty.</span>';
}
?>
</body>
</html>
