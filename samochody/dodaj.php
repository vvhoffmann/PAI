<?php

require_once 'funkcje.php';


sprawdzLogowanie();

$_SESSION['error1']="";
if (isset($_POST['dodaj'])) {
    $_SESSION['ok']=true;
    
    $klasy = ['marka' => '', 'model' => '', 'rok' => '','pojemnosc' => ''];
    
    if (empty(trim($_POST['marka']))) {
        $_SESSION['error1']="Niepoprawna marka";
        $_SESSION['ok']=false;
        $klasy['marka']='pusto';
    }

    if (empty(trim($_POST['model']))) {
        $_SESSION['error1']="Niepoprawny model";
        $_SESSION['ok']=false;
        $klasy['model']='pusto';
    }

    $options = [
        'options' => [
            'min_range' => 1900,
        ]
    ];
	if (empty($_POST['rok'])) {
        $_SESSION['error1'] = "Pole rok jest puste";
        $_SESSION['ok']=false;
        $klasy['rok']='pusto';
	} elseif (filter_var($_POST['rok'], FILTER_VALIDATE_INT, $options) == false) {
        $_SESSION['error1'] = "Pole rok ma niepoprawną wartość";
        $_SESSION['ok']=false;
        $klasy['rok']='np';
    }
    
    if (empty($_POST['pojemnosc'])) {
        $_SESSION['error1'] = "Pole pojemnosc jest puste";
        $_SESSION['ok']=false;
        $klasy['pojemnosc']='pusto';
	} elseif (filter_var($_POST['pojemnosc'], FILTER_VALIDATE_FLOAT) == false) {
        $_SESSION['error1'] = "Pole rok ma niepoprawną wartość";
        $_SESSION['ok']=false;
        $klasy['pojemnosc']='np';
    }

    if($_SESSION['ok'])
    {
    $pdo = polacz();
    $_SESSION['ok']=true;
    $stmt = $pdo->prepare("INSERT INTO samochody (marka, model, rok, pojemnosc, typ_silnika, liczba_poduszek, abs, esp) 
    VALUES (:marka, :model, :rok, :pojemnosc, :typ_silnika, :liczba_poduszek, :abs, :esp)");
    $wynik = $stmt->execute([
        'marka' => $_POST['marka'],
        'model' => $_POST['model'],
        'rok' => $_POST['rok'],
        'pojemnosc' => $_POST['pojemnosc'],
        'typ_silnika' => $_POST['typ_silnika'],
        'liczba_poduszek' => $_POST['liczba_poduszek'],
        'abs' => $_POST['abs'],
        'esp' => $_POST['esp'],
    ]);
        
    
    if ($wynik == true ) {
        header("Location: index.php?komunikat=1");
        exit();
    } else {
        die("Operacja się nie powiodła: " . $pdo->errorInfo());
    }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dodaj</title>
    <style type="text/css">
    .pusto {
    	background-color: red;
    }
    
    .np {
    	background-color: blue;
    }
    </style>
    <meta charset="utf-8">
</head>

<body>
<?php 
    if (isset ($_SESSION['error1']))
    {
        echo '<p>'.$_SESSION['error1'].'</p>';
    }
?>

    <form method="post" action="">
        <table>
            <tr>
                <td>Marka</td>
                <td><input type="text" name="marka"  class="<?=$klasy['marka'] ?>" value="<?= $_POST['marka'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Model</td>
                <td><input type="text" name="model"  class="<?=$klasy['model'] ?>" value="<?= $_POST['model'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Rok</td>
                <td><input type="text" name="rok"  class="<?=$klasy['rok'] ?>" value="<?= $_POST['rok'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Typ silnika</td>
                <td>
                    <select name="typ_silnika">
                        <option value="benzyna" >benzyna</option>
                        <option value="diesel" >diesel</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Pojemność</td>
                <td><input type="text" name="pojemnosc"  class="<?=$klasy['pojemnosc'] ?>" value="<?= $_POST['pojemnosc'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Liczba Poduszek</td>
                <td>
                    <select name="liczba_poduszek">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>ABS</td>
                <td>
                    <input type="radio" name="abs" value="tak" <?= ($_POST['abs'] ?? '') == 'tak' ? 'checked' : '' ?>/>TAK
                    <input type="radio" name="abs" value="nie" <?= ($_POST['abs'] ?? '') == 'nie' ? 'checked' : '' ?>/>NIE
                </td>
            </tr>
            <tr>
                <td>ESP</td>
                <td>
                    <input type="radio" name="esp" value="tak" <?= ($_POST['esp'] ?? '') == 'tak' ? 'checked' : '' ?>/>TAK
                    <input type="radio" name="esp" value="nie" <?= ($_POST['esp'] ?? '') == 'nie' ? 'checked' : '' ?>/>NIE
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="dodaj" value="Dodaj" /></td>
            </tr>
        </table>
    </form>

    <p>
        <a href="index.php">[ Powrót do listy ]</a>
    </p>
</body>

</html>