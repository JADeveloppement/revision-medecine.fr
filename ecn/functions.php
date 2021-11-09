<?
	$salt = "2019ecn";

	// CONNEXION
	if ($_POST['action'] == 1){
		$user = trim($_POST['login']);
		$pwd = crypt(trim($_POST['password']), $salt);
		if (!file_exists("bddusers/".$user))
			echo -1;
		else {
			$f = fopen("bddusers/".$user, "r");
			$line = fgets($f);
			$line = fgets($f);
			$a = explode("2019ecn", $line);
			if ($pwd == $a[3])
			{
				setcookie("ECN-SUIVI-var", $user, time()+2678400);
				setcookie("ECN-SUIVI-nom", $a[1]." ".$a[0]);
				fputs(fopen("bddusers/".$user.".lock", "w"), date('j/n/Y H:i'));
				echo 1;
			}
			else
				echo 0;
		}
	}

	// INSCRIPTION
	if($_POST['action'] == 2){
		$nom = trim($_POST['nom']);
		$prenom = trim($_POST['prenom']);
		$mail = trim($_POST['mail']);
		$password = crypt(trim($_POST['password']), $salt);
		$user = trim($_POST['user']);
		$promo = trim($_POST['promo']);
		$ville = trim($_POST['ville']);

		if (file_exists("bddusers/".$user)){
			echo -1;
		}
		else {
			/// FICHE 777ecn NBRELECTURE 2019ecn
			$f = fopen("bddusers/".$user, "w");
			for ($a = 0; $a < 363; $a++)
				fputs($f, "0777ecn02019ecn");
			fputs($f, "\n".$nom.$salt.$prenom.$salt.$user.$salt.$password.$salt.$mail.$salt.$promo.$salt.$ville.$salt.time()."\n"."-1".$salt.time());
			fclose($f);
			echo 1;
		}
	}

	// RELU
	if($_GET['action'] == 3){
		$item = intval(trim($_GET['nbitem']));
		$f = fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "r");
		$line1 = explode("2019ecn", trim(fgets($f)));
		$line2 = trim(fgets($f));
		$line3 = trim(fgets($f));
		unlink("bddusers/".$_COOKIE["ECN-SUIVI-var"]);

		$c = explode("777ecn", $line1[$item]);
		$k = (intval($c[1])+1);
		$c[1] = $k;
		$d = $c[0]."777ecn".$c[1];
		$line1[$item] = $d;
		$line4 = implode("2019ecn", $line1)."\n".$line2."\n".$line3;
		fputs(fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "w"), $line4);
		echo $k;
	}

	//FICHE
	if($_GET['action'] == 4){
		$item = intval(trim($_GET['nbitem']));
		$f = fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "r");
		$line1 = explode("2019ecn", trim(fgets($f)));
		$line2 = trim(fgets($f));
		$line3 = trim(fgets($f));
		unlink("bddusers/".$_COOKIE["ECN-SUIVI-var"]);

		$c = explode("777ecn", $line1[$item]);
		if (intval($c[0]) == 1)
			$c[0] = 0;
		else $c[0] = 1;
		$d = $c[0]."777ecn".$c[1];
		$line1[$item] = $d;
		$line4 = implode("2019ecn", $line1)."\n".$line2."\n".$line3;
		fputs(fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "w"), $line4);
		echo $c[0];
	}

	//EDITER
	if($_GET['action'] == 5	){
		$item = intval(trim($_GET['nbitem']));
		$nv = intval(trim($_GET['nv']));
		$f = fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "r");
		$line1 = explode("2019ecn", trim(fgets($f)));
		$line2 = trim(fgets($f));
		$line3 = trim(fgets($f));
		unlink("bddusers/".$_COOKIE["ECN-SUIVI-var"]);

		$c = explode("777ecn", $line1[$item]);
		$c[1] = $nv;
		$d = $c[0]."777ecn".$c[1];
		$line1[$item] = $d;
		$line4 = implode("2019ecn", $line1)."\n".$line2."\n".$line3;
		fputs(fopen("bddusers/".$_COOKIE["ECN-SUIVI-var"], "w"), $line4);
		echo $nv;
	}

	//CONTACT
	if ($_POST['action'] == 6){
		$timestamp = time();
		$donnees = $_POST['nom'].$salt.$_POST['prenom'].$salt.$_POST['mail'].$salt.$_POST['sujet'].$salt.$_POST['message'].$salt.$timestamp;
		do {
			if (file_exists("contact/".$timestamp))
				$timestamp++;
			else fputs(fopen("contact/".$timestamp, "w"), $donnees);
		} while(file_exists("contact/".$timestamp));
	}

	//PAIEMET EFFECTUE 
	if ($_POST['action'] == 7){
		$username = $_COOKIE['ECN-SUIVI-var'];
		$f = fopen("bddusers/".$username, "r");
		$line1 = trim(fgets($f));
		$line2 = trim(fgets($f));
		fclose($f);
		unlink("bddusers/".$username);
		fputs(fopen("bddusers/".$username, "w"), $line1."\n".$line2."\nPayé");
	}

	// MODIFIER VALEURS
	if ($_POST['action'] == 8){
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$mail = $_POST['mail'];
		if (strlen($_POST['mdp']) >= 5)
			$mdp = crypt($_POST['mdp'], $salt);
		$promo = $_POST['promo'];
		$ville = $_POST['ville'];

		$f = fopen("bddusers/".$_COOKIE['ECN-SUIVI-var'], "r");
		$line1 = trim(fgets($f));
		$line2 = explode("2019ecn", trim(fgets($f)));
		$line3 = trim(fgets($f));
		fclose($f);
		unlink("bddusers/".$_COOKIE['ECN-SUIVI-var']);

		$line2[0] = $nom;
		$line2[1] = $prenom;
		if (strlen($_POST['mdp']) >= 5)
			$line2[3] = $mdp;
		$line2[4] = $mail;
		$line2[5] = $promo;
		$line2[6] = $ville;
		$line4 = implode("2019ecn", $line2);
		$file = $line1."\n".$line4."\n".$line3;
		fputs(fopen("bddusers/".$_COOKIE['ECN-SUIVI-var'], "w"), $file);
	}

	// CLASSEMENT
	if($_POST['action'] == 9){
		$totalrelu = $_POST['nb'];
		$listeusers = scandir("bddusers/");
		$nbreluperusers = array();
		$indice = 0;
		foreach($listeusers as $i){
			if (strlen($i) >= 4 && !(strpos($i, "index") !== false) && !(strpos($i, ".lock") !== false)){
				array_push($nbreluperusers, 0);
				$line = explode("2019ecn", trim(fgets(fopen("bddusers/".$i, "r"))));
				foreach($line as $j){
					if ((explode("777ecn", $j))[1] >= 1)
						$nbreluperusers[$indice]++;
				}
				$indice++;
			} 
		}

		## Classement par ordre croissant des scores de relectures
		sort($nbreluperusers);
		$a = 0;
		$classement = count($nbreluperusers);
		do {
			if ($totalrelu >= $nbreluperusers[$a])
				$classement = $a;
			$a++;
		}while ($a < count($nbreluperusers));
		$classement = count($nbreluperusers) - $classement + 1;
		echo $classement.$salt.count($nbreluperusers);
	}

?>