<?php
$dbhost="ppodlas.nazwa.pl"; $dbuser="ppodlas_git"; $dbpassword="Richards!995"; $dbname="ppodlas_git";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$polaczenie) {
    echo "Błąd połączenia z MySQL." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>