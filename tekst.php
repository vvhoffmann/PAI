<?php
    session_start();
    $login = $_SESSION["login"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Comatible" content="ID=edge">
    <meta name="author" content="Wiktoria Hoffmann">
    <title>tekst</title>
</head>
<body>
    Witaj + <?= $login?>
</body>