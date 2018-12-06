<?php
$login = $_COOKIE['imie'];
$dirname = $_POST['folder'];
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if (IsSet($dirname)) {
        move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "zad7/Users/$login" . $_FILES['plik']['name']);
    } else {
        move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "zad7/Users/$login/" . $_FILES['plik']['name']);
    }
}
?>

