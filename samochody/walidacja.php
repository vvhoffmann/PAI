<?php
	
if (isset($_POST['wyslij'])) {
	// inicjalizacja tablicy z klasami błędów
	$klasy = ['imie' => '', 'rok' => '', 'plec' => ''];
	$blad = false;
	
    // sprawdzenie czy pole 'imie' jest puste
	if (empty(trim($_POST['imie']))) {
		$klasy['imie'] = 'puste';
		$blad = true;
	}

	// sprawdzenie czy pole 'rok' jest puste, a następnie, czy jest liczbą z zakresu 1950 - 2100
    $options = [
        'options' => [
            'min_range' => 1950,
            'max_range' => 2100,
        ]
    ];
	if (empty($_POST['rok'])) {
		$klasy['rok'] = 'puste';
		$blad = true;
	} elseif (filter_var($_POST['rok'], FILTER_VALIDATE_INT, $options) == false) {
		$klasy['rok'] = 'format';
		$blad = true;
	}
	
	// sprawdzenie pola płeć
	if (empty($_POST['plec'])) {
		$klasy['plec'] = 'puste';
		$blad = true;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Walidacja</title>
    <style type="text/css">
    .puste {
    	background-color: red;
    }
    
    .format {
    	background-color: blue;
    }
    </style>
</head>

<body>

<?php if (isset($blad) && !$blad): // w przypadku, gdy dane są poprawne, wyświetl komunikat ?>
	<p style='color: red;'>Dane poprawne.</p>
<?php endif; ?>

<form method="post" action="">
	Imię: 
	<input type="text" name="imie" class="<?=$klasy['imie'] ?>" value="<?= $_POST['imie'] ?? '' ?>" />
	<br/>
	
	Rok: 
	<input type="text" name="rok" class="<?=$klasy['rok'] ?>" value="<?= $_POST['rok'] ?? '' ?>" />
	<br/>
	
	<div class="<?=$klasy['plec'] ?>">
		Płec: 
		<input type="radio" name="plec" value="k" <?= ($_POST['plec'] ?? '') == 'k' ? 'checked' : '' ?> /> kobieta
		<input type="radio" name="plec" value="m" <?= ($_POST['plec'] ?? '') == 'm' ? 'checked' : '' ?> /> mężczyzna
	</div>
	
	<input type="submit" name="wyslij" value="Wyślij" />
</form>
</body>
</html>
