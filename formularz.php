<?php
    session_start();
    $login = "wiktoria";
    $haslo = "haslo";
    if(!empty($_POST["login"]) || !empty($_POST["haslo"])){
        if($_POST["login"] == $login && $_POST["haslo"] == $haslo)
        {
            $_SESSION["login"]=$_POST["login"];
            $_SESSION["haslo"]=$_POST["haslo"];
            header("Location: tekst.php");
            exit();
        }
        else $_SESSION["error"]= true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Comatible" content="ID=edge">
    <meta name="author" content="Wiktoria Hoffmann">
    <title>Formularz logowania</title>
</head>
<body>
    <form action="formularz.php" method="post">
        <input type="text" name="login" placeholder="Login">
        <br>
        <input type="password" name="haslo" placeholder="Hasło">
        <br>
        <button type="submit" name="zaloguj">Zaloguj</button>
    </form>
    <?php
    if(isset($_SESSION["error"])) {
        echo "<p style='color:red'>Niepoprawny login lub haslo</p>";
        unset($_SESSION["error"]);
    }
    ?>
</body>