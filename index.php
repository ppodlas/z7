<?php
include_once "connDB.php";
$login = $_COOKIE['imie'];
$plik = $_POST['plik'];
$folder = $_POST['folder'];

if ($folder == $login) {
    $plik = $_POST['plik'];
    if (isset($_POST['wyslij'])) {
        $max_rozmiar = 5000;
        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
            if ($_FILES['plik']['size'] > $max_rozmiar) {
                echo "Przekroczenie rozmiaru $max_rozmiar";
            } else {
                echo 'Odebrano plik: ' . $_FILES['plik']['name'] . '<br/>';
                if (isset($_FILES['plik']['type'])) {
                    echo 'Typ: ' . $_FILES['plik']['type'] . '<br/>';
                }
                move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/zad7/Users/$login/" . $_FILES['plik']['name']);
            }
        } else {
            echo '<span class="error" ">Błąd przy przesyłaniu danych!</span>';
        }
    }
} else {
    $plik = $_POST['plik'];
    if (isset($_POST['wyslij'])) {
        $max_rozmiar = 50000;
        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
            if ($_FILES['plik']['size'] > $max_rozmiar) {
                echo "Przekroczenie rozmiaru $max_rozmiar";
            } else {
                echo '<span class="success">Odebrano plik:' . $_FILES['plik']['name'] . '<br/>';
                if (isset($_FILES['plik']['type'])) {
                    echo 'Typ: ' . $_FILES['plik']['type'] . '</span><br/>';
                }
                move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/zad7/Users/$login/$folder/" . $_FILES['plik']['name']);
            }
        } else {
            echo '<span class="error">Błąd przy przesyłaniu danych!</span>';
        }
    }
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
        z7 Dodaj pliki do folderu
    </h1>
</div>
<div class="topnav">
    <center>
        <a href="">Zalogowany jako: <?php echo $_COOKIE['imie']; ?></a>
    </center>
    <a href="logout.php" style="float: right">Log out</a>
</div>
<br><br><br>
<div class="row">

    <div class="col"></div>
    <table cellpadding="5" style="width: 1000px">
        <tr>
            <td>
                <div class="col">
                    <h3>Prześlij plik</h3>
                    <form method="post" ENCTYPE="multipart/form-data">

                        <h5>Wybierz folder</h5>
                        <select name="folder" class="custom-select">
                            <?php

                            foreach (glob("Users/$login/*", GLOB_ONLYDIR) as $dir) {
                                $dir = str_replace("Users/$login/", '', $dir);
                                echo '<option value ="' . $dir . '"> ' . $dir . '<br>';
                            }
                            ?>
                        </select>
                        <input type="file" name="plik"/>
                        <input class="btn" type="submit" name="wyslij" value="Wyślij plik"/>
                    </form>
                </div>
            </td>
            <td>
                <div class="col">
                    <div class="form-group">
                        <h3>Stwórz podkatalog</h3>
                        <form method="post" action="mkdir.php">
                            <input type="text" class="form-control" style="width: 400px" name="dirname"
                                   placeholder="Wpisz nazwe folderu"/>
                            <input class="btn" type="submit" value="Stwórz folder"/>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="col"></div>
</div>
<hr/>
<div class="row">
    <div class="col" style="width: 15%">

    </div>
    <div class="col" style="width: 70%">
        <h4><b>Twoje pliki:</b></h4>
        <?php
        $login = $_COOKIE['imie'];
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/zad7/Users/" . $login;
        function folders($dir)
        {
            $dirh = @opendir($dir) or die("Unable to open $dir");
            $dirn = end(explode("/", $dir));
            echo("<li>$dirn\n");
            echo "<ul>\n";
            while (false !== ($file = readdir($dirh))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . "/" . $file)) {
                        folders($dir . "/" . $file);
                    } else {
                        echo "<li><a href='$dir/$file' download>$file</a></li>";
                    }
                }
            }
            echo "</ul>\n";
            echo "</li>\n";
            closedir($dirh);
        }

        folders($dir);
        ?>
    </div>
    <div class="col" style="width: 15%;"></div>
</div>
</body>
</html>