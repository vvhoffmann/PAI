<?php
	session_start();
	if(isset($_POST["tlo"]) && isset($_POST["fontSize"])){
		$_SESSION["tlo"] = $_POST["tlo"];
		$_SESSION["font"] = $_POST["font"];
		$_SESSION["fontSize"] = $_POST["fontSize"];
		header("Location: tekst2.php");
		exit();
	}
	
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<style type="text/css">
		ul#menu {
			float: left;
			width: 10%;
			list-style-type: none;
		}

		div#tresc {
			float: left;
			width: 85%;
		}

		div#tresc table span {
			padding: 3px;
		}
	</style>
</head>

<body>
	<ul id="menu">
		<li><a href="tekst2.php">Tekst</a></li>
		<li><a href="ustawienia.php">Ustawienia</a></li>
	</ul>
	<div id="tresc">
		<form method="post" action="ustawienia.php">
			<table cellpadding="4">
				<tr>
					<td>Kolor tla strony:</td>
					<td>
						<input type="radio" value="#BAFF49" name="tlo"/> <span style="background-color: #BAFF49">#BAFF49</span><br />
						<input type="radio" value="#8E9BFF" name="tlo"/> <span style="background-color: #8E9BFF">#8E9BFF</span><br />
						<input type="radio" value="#FFEFBF" name="tlo"/> <span style="background-color: #FFEFBF">#FFEFBF</span><br />
					</td>
				</tr>
				<tr>
					<td>Krój czcionki:</td>
					<td>
						<select name="font">
							<option>Verdana</option>
							<option>Arial</option>
							<option>Courier New</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Wielkość czcionki:</td>
					<td><input type="text" name="fontSize" style="width: 30px" />px</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="zapisz" value="Zapisz" /></td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>