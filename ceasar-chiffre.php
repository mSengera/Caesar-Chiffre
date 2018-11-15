<?php
    function chiffreCodec($str, $s, $from) {
        $count = strlen($from);
        $s = intval($s) % $count;
        $to = substr($from, $s) . substr($from, 0, $s);
        return strtr($str, $from, $to);
    }
	
	function chiffreDecodec($str, $s, $from) {
		$s = $s - 2 * $s;
        $count = strlen($from);
        $s = intval($s) % $count;
        $to = substr($from, $s) . substr($from, 0, $s);
        return strtr($str, $from, $to);
    }
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ces&auml;r-Chiffre Codierung</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h1>In C&auml;sar-Chiffre codieren</h1>
			<form action="/index.php?encode=1" method="post">
				<p>C&auml;sar-Chiffre Code<br />
				   <input type="text" name="code" style="width: 500px;"/></p>
				<p>Verschiebung<br />
				   <input type="text" name="verschiebung" style="width: 500px;"/>	
				</p>
				<p>Zeichenraum<br />
				   <input type="text" value="ABCDEFGHIHKLMNOPQRSTUVWXYZ" name="zeichenraum" style="width: 500px;"/>	
				</p>
				<p><input type="submit" value="Codieren"></p>
			</form>
		</div>
		<div class="col-md-6">
			<h1>Decode C&auml;sar-Chiffre</h1>
			<form action="/index.php?decode=1" method="post">
				<p>C&auml;sar-Chiffre Code<br />
				   <input type="text" name="code" style="width: 500px;"/></p>
				<p>Bis zur Verschiebung probieren:<br />
				   <input type="text" name="versuche" style="width: 500px;"/>	
				</p>
				<p>Zeichenraum<br />
				   <input type="text" value="ABCDEFGHIHKLMNOPQRSTUVWXYZ" name="zeichenraum" style="width: 500px;"/>	
				</p>
				<p><input type="submit" value="Decodieren"></p>
			</form>
		</div>
	</div>
</div>
		

<?php

	// Ausgabe & Verarbeitung
	if($_GET["decode"] == 1) {
		echo "<div class='container-fluid'><div class='row'><div class='col-md-6'></div><div class='col-md-6'>";
		echo "<h1>Ergebnis: Decode C&auml;sar-Chiffre</h1>";
		echo "<h3>Decodieren von: ". $_POST["code"] ."</h3>";
		
		$i = 0;
		while($i < $_POST["versuche"] + 1) {
			echo "<p>Ergebnis mit der Verschiebung ". $i .": "; echo chiffreDecodec($_POST["code"], $i, $_POST["zeichenraum"]); echo "</p>";
			$i++;
		}
		
		echo "</div></div></div>";
		
	} elseif ($_GET["encode"] == 1) {
		echo "<div class='container-fluid'><div class='row'><div class='col-md-6'>";
		echo "<h1>Ergebnis: In C&auml;sar-Chiffre Codieren</h1>";
		echo "<h3>Codieren von: ". $_POST["code"] ." mit der Verschiebung ". $_POST["verschiebung"] ."</h3>";
		
		echo "<p>Ergebnis: "; echo chiffreCodec($_POST["code"], $_POST["verschiebung"], $_POST["zeichenraum"]); echo "</p>";
		
		echo "</div><div class='col-md-6'></div></div></div>";
		
	}
	
?>
</body>
</html>

