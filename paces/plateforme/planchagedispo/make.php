<?
	$f = fopen("file", "r");
	$i = 0;
	$t = "00";
	while (($line = fgets($f)) !== false){
		$l = trim($line);
		if (strlen($l) > 5 && strpos($l, "UE5") === false){
			if (strpos($l, "Question 0") !== false){
				$i++;
				if ($i < 10) $t = "00$i";
				else if ($i < 100) $t = "0$i";
				else $t = "$i";

				echo "<br><b>Question $t</b><br>";
			}
			else {
				if (strpos($l, "Réponse") !== false)
					echo "<br>$l<br>";
				else echo "$l<br>";
			}
		}
	}
	fclose($f);
?>