<?
	$salt = "2019paces";
	$username = $_COOKIE["PACES-DEMOCRITE"];
	// RELIRE COURS
	if ($_POST['action'] == 1){
		$item = intval(trim($_POST['item']));
		$f = fopen("../bddusers/".$username, "r");
		$lines = array();

		while (($line = fgets($f)) !== false)
			array_push($lines, trim($line));
		fclose($f);

		$line1 = explode("2019paces", $lines[1]);
		unlink("../bddusers/".$_COOKIE["PACES-DEMOCRITE"]);
		$z = (intval($line1[$item])+1);
		$line1[$item] = $z;

		$lines[1] = implode("2019paces", $line1);
		$line = implode("\n", $lines);
		fputs(fopen("../bddusers/".$_COOKIE["PACES-DEMOCRITE"], "w"), $line);
		echo $line1[$item];
	}

	// EDITER
	if ($_POST['action'] == 2){
		$item = intval(trim($_POST['item']));
		$nv = intval(trim($_POST['nvnb']));
		$f = fopen("../bddusers/".$_COOKIE["PACES-DEMOCRITE"], "r");
		$lines = array();

		while (($line = fgets($f)) !== false)
			array_push($lines, trim($line));
		fclose($f);

		$line1 = explode("2019paces", $lines[1]);
		unlink("../bddusers/".$_COOKIE["PACES-DEMOCRITE"]);
		$line1[$item] = $nv;

		$lines[1] = implode("2019paces", $line1);
		$line = implode("\n", $lines);
		fputs(fopen("../bddusers/".$_COOKIE["PACES-DEMOCRITE"], "w"), $line);
		echo $line1[$item];
	}

	// COURS ACHETE
	if ($_POST['action'] == 3){
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$cours = $_POST['param'];
		$listecoursfiche = fopen("listecoursfiche", "r");
		while (($line = fgets($listecoursfiche)) !== false){
			if (strpos(trim($line), $cours) !== false){
				$a = explode($salt, trim($line));
				fputs(fopen("../bddusers/cours/".$_COOKIE['PACES-DEMOCRITE'], "a+"), $a[2]."---");
			}
		}
		fclose($listecoursfiche);
	}

	// MAJ SUIVI cours
	if ($_POST['action'] == 4){
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$offre = $_POST['offre'];
		$f = fopen("../bddusers/".$username, "r");
		$lines = array();
		while (($line = fgets($f)) !== false){
			array_push($lines, trim($line));
		}
		fclose($f);
		$a = explode($salt, $lines[0]);
		$a[11] = $offre;
		$lines[0] = implode($salt, $a);
		$donnees = implode("\n", $lines);
		fputs(fopen("../bddusers/".$username, "w"), $donnees);
	}

	//CORRECTION
	if ($_POST['action'] == 5){
		$planchage = $_POST['file'];
		$eleve = explode("2019paces", $_POST['eleve']);

		$note = 0;
		$erreur = 0;

		$correction = fopen("planchagedispo/".$planchage, "r");
		$f = fgets($correction);

		$f = explode("2019paces", trim(fgets($correction)));
		$notemax = sizeof($f);
		$j = 0;
		foreach($f as $i){
			if ($i == $eleve[$j])
				$note++;
			else {
				if(strlen($i) == 2)
					$note--;
				$erreur++;
			}
			$j++;
		}
		if ($note < 0) $note = 0;
		echo "NOTE : ".$note." ERREUR : ".$erreur." NOTEMAX : ".$notemax;
		fputs(fopen("participation/".$username, "a+"), $planchage.$salt.implode($salt, $eleve).$salt.$note."\n");
	}

	// OFFRE REVISION
	if ($_POST['action'] == 6){
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$offre = $_POST['offre'];
		$f = fopen("../bddusers/".$username, "r");
		$lines = array();
		while (($line = fgets($f)) !== false){
			array_push($lines, trim($line));
		}
		fclose($f);
		$a = explode($salt, $lines[0]);
		$a[12] = $offre;
		$lines[0] = implode($salt, $a);
		$donnees = implode("\n", $lines);
		fputs(fopen("../bddusers/".$username, "w"), $donnees);
	}
?>