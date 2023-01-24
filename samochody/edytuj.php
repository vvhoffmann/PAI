<?php

require_once 'funkcje.php';

sprawdzLogowanie();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $pdo = polacz();

    if (isset($_POST['zapisz'])) {
        // obsługa edycji rekordu
        $stmt = $pdo->prepare("UPDATE samochody SET marka = :marka, model = :model, rok = :rok, pojemnosc=:pojemnosc, typ_silnika = :typ_silnika, liczba_poduszek=:liczba_poduszek, abs=:abs, esp=:esp WHERE id = :id");
        $wynik = $stmt->execute([
            'marka' => $_POST['marka'],
            'model' => $_POST['model'],
            'rok' => $_POST['rok'],
            'id' => $id,
            'pojemnosc' => $_POST['pojemnosc'],
            'typ_silnika' => $_POST['typ_silnika'],
            'liczba_poduszek' => $_POST['liczba_poduszek'],
            'abs' => $_POST['abs'],
            'esp' => $_POST['esp'],
        ]);

        if ($wynik == true) {
            header("Location: edytuj.php?id=$id&komunikat=1");
            exit();
        } else {
            die("Operacja się nie powiodła: " . $pdo->errorInfo());
        }
    } else {
        // wczytanie danych samochodu z bazy
        $stmt = $pdo->prepare("SELECT * FROM samochody WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $wiersz = $stmt->fetch();

        if (!$wiersz) {
            die("Nie znaleziono podanego samochodu!");
        }
    }
} else {
    die("Nie podano ID");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edycja</title>
    <meta charset="utf-8">
</head>

<body>
    <?php if (($_GET['komunikat'] ?? null) == 1) : ?>
        <p style='color:red; font-weight:bold;'>Dane zostaly zapisane.</p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td>Marka</td>
                <td><input type="text" name="marka" value="<?= $wiersz['marka'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Model</td>
                <td><input type="text" name="model" value="<?= $wiersz['model'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Rok</td>
                <td><input type="text" name="rok" value="<?= $wiersz['rok'] ?? '' ?>" /></td>
            </tr>
            <tr>
                <td>Typ silnika</td>
                <td>
                    <select name="typ_silnika">
                        <option value="benzyna" <?= ($wiersz['typ_silnika'] ?? '') == 'benzyna' ? 'selected' : '' ?>>benzyna</option>
                        <option value="diesel" <?= ($wiersz['typ_silnika'] ?? '') == 'diesel' ? 'selected' : '' ?>>diesel</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Pojemność</td>
                <td><input type="text" name="pojemnosc" value="<?= $wiersz['pojemnosc'] ?? '' ?>" /></td>
            </tr>

            <tr>
                <td>Liczba Poduszek</td>
                <td>
                    <select name="liczba_poduszek">
                        <option value="1" <?= ($wiersz['liczba_poduszek'] ?? '') == '1' ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= ($wiersz['liczba_poduszek'] ?? '') == '2' ? 'selected' : '' ?>>2</option>
                        <option value="3" <?= ($wiersz['liczba_poduszek'] ?? '') == '3' ? 'selected' : '' ?>>3</option>
                        <option value="4" <?= ($wiersz['liczba_poduszek'] ?? '') == '4' ? 'selected' : '' ?>>4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>ABS</td>
                <td>
                    <input type="radio" name="abs" value="tak" />TAK
                    <input type="radio" name="abs" value="nie" />NIE
                </td>
            </tr>
            <tr>
                <td>ESP</td>
                <td>
                    <input type="radio" name="esp" value="tak" />TAK
                    <input type="radio" name="esp" value="nie" />NIE
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="zapisz" value="Zapisz" /></td>
            </tr>
        </table>
    </form>

    <p>
        <a href="index.php">[ Powrót do listy ]</a>
    </p>
</body>

</html>