<?
	$salt = "2019paces";

	/**
	** START POUR LISTECOURS S2
	** 21 UE5
	** 45 UE6
	** 66 UE7SH
	** 113 UE7SP
	**
	**/

	/**
	** SUIVI COURS 	: 0: gratuit, 1: S1, 2: S2, 3: Annuel
	** PLANCHAGE 	: 0: aucun, 1: S1, 2: S2, 3: Annuel, 4: Abonnement
	**
	** FICHIER ETUDIANT
	** LINE 1 : NOM PRENOM DATEDENAISSANCE MAIL ADRESSE CODEPOSTALE VILLE TELEPHONE MDP BACSERIE MENTION SUIVICOURS 
	** 			PLANCHAGE COURS TOTALPAYE
	** LINE 2 : RELECTURE COURS
	** LINE 3 : TIMESTAMP INSCRIPTION
	** LINE 4 : TIMESTAMP CONNEXION
	** LINE 5 : MOIS PAYE (si abonnement)
	** 
	**/

	// INSCRIPTION
	if ($_POST['action'] == 1){
		$donnees = [$_POST['nom'], $_POST['prenom'], $_POST['ddn'], $_POST['mail'], $_POST['adresse'], $_POST['codepostale'], $_POST['ville'], $_POST['telephone'], crypt($_POST['password'], $salt), $_POST['bacserie'], $_POST['mention'], $_POST['suivicours'], $_POST['planchage'], $_POST['cours'], $_POST['total']];
		
		// NOM FICHIER
		$i = 0;
		$username = trim(substr(strtolower($_POST['prenom']), 0, 1)).trim(substr(strtolower($_POST['nom']), 0, strlen(strtolower($_POST['nom']))));

		if (file_exists("bddusers/".$username))
			do {
				$username = trim(substr(strtolower($_POST['prenom']), 0, 1)).trim(substr(strtolower($_POST['nom']), 0, strlen(strtolower($_POST['nom'])))).$i;
				$i++;
			}while (file_exists("bddusers/".$username));
		
		// LINE 1 fichier
		$line1 = implode($donnees, $salt)."\n";
		
		// LINE 2 FICHIER
		$b = "";

		$s = intval($_POST['suivicours']);
		$t = intval(time());
		$u = intval(strtotime("25-01-2020"));

		if ($s == 1 || ($s == 0 && $t < $u))
			for($a = 0; $a < 156; $a++)
				$b .= "0".$salt;
		else if ($s == 2 || ($s == 0 && $t >= $u)) 
			for($a = 0; $a < 126; $a++)
				$b .= "0".$salt;
		else if (intval($_POST['suivicours']) == 3)
			for($a = 0; $a < 282; $a++)
				$b .= "0".$salt;

		// RELECTURE
		$line2 = $b."\n";
		
		// TIMESTAMP INSCRIPTION
		$line3 = time()."\n";

		fputs(fopen("bddusers/".$username, "w"), $line1.$line2.$line3);
		fopen("bddusers/cours/".$username, "w");
		fopen("bddusers/planchages/".$username, "w");
		echo $username;

		/* ENVOYER MAIL */
		function sanitize_my_email($field) {
			$field = filter_var($field, FILTER_SANITIZE_EMAIL);
			if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
				return true;
			} else {
				return false;
			}
		}

		$to_email = 'contact@revision-medecine.fr';
		$subject = 'Inscription : '.$_POST['nom'].' '.$_POST['prenom'].' ('.date("d/m/Y H:i:s").')';
		$message = '<b>NOM : '.$_POST['nom'].'</b><br>
					<b>PRENOM : '.$_POST['prenom'].'</b><br>
					<b>DATE DE NAISSANCE : '.$_POST['ddn'].'</b><br>
					<b>E-MAIL : '.$_POST['mail'].'</b><b>TELEPHONE : '.$_POST['telephone'].'</b><br>
					<b>ADRESSE : '.$_POST['adresse'].' </b><b>CODE POSTALE : '.$_POST['codepostale'].' </b><b>VILLE : '.$_POST['ville'].'</b><br>
					<b>BAC : '.$_POST['bacserie'].' </b><b>MENTION : '.$_POST['mention'].'</b><br>
					<b>LOGIN : '.$username.'</b><br>
					<b>OFFRE : </b><b>SUIVI : '.$_POST['suivicours'].'</b> <b>PLANCHAGE : '.$_POST['planchage'].'</b> <b>COURS : '.$_POST['cours'].'</b>';
		$headers = "From : www.revision-medecine.fr/paces\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		//check if the email address is invalid $secure_check
		$secure_check = sanitize_my_email($to_email);
		if ($secure_check == false) {
			
		} else { 
			mail($to_email, $subject, $message, $headers);
		}

	}

	// CONNEXION
	if ($_POST['action'] == 2){
		$result = -1;
		if (!file_exists("bddusers/".$_POST['login']))
			$result = -1;
		else {
			$r = explode($salt, trim(fgets(fopen("bddusers/".$_POST['login'], "r"))));
			if (crypt($_POST['password'], $salt) == $r[8]){
				$result = 0;
				setcookie("PACES-DEMOCRITE", $_POST['login'], time()+(24*3600*30));
			}
			else $result = -2;
		}
		echo $result;

		if (file_exists("bddusers/historique/".$_POST['login'].".co")){
			$f = fopen("bddusers/historique/".$_POST['login'].".co", "r");
			$a = fgets($f); $a = fgets($a);
			fclose($f);
			fputs(fopen("bddusers/historique/".$_POST['login'].".co", "w"), $a."\n".date("d/m/Y H:i:s", time()));
		}
		else fputs(fopen("bddusers/historique/".$_POST['login'].".co", "w"), $a."\n".date("d/m/Y H:i:s", time()));
	}

	// DECONNEXION
	if ($_POST['action'] == 3){
		setcookie("PACES-DEMOCRITE", 0, 0);
	}

	// EDITER PROFIL
	if ($_POST['action'] == 4){
		$f = fopen("bddusers/".$_COOKIE['PACES-DEMOCRITE'], "r");
		$file = array();
		while (($line = fgets($f)) !== false)
			array_push($file, trim($line));
		fclose($f);

		$identite = explode("2019paces", $file[0]);

		if (crypt($_POST['password'], $salt) != $identite[8])
			echo -1;
		else {
			if ($_POST['confirmpassword'] == -1){
				$donnees = [$_POST['nom'], $_POST['prenom'], $_POST['ddn'], $_POST['mail'], $_POST['adresse'], $_POST['codepostale'], $_POST['ville'], $_POST['telephone'], $identite[8], $_POST['bacserie'], $_POST['mention'], $_POST['suivicours'], $_POST['planchage'], $_POST['total']];
			}
			else {
				$donnees = [$_POST['nom'], $_POST['prenom'], $_POST['ddn'], $_POST['mail'], $_POST['adresse'], $_POST['codepostale'], $_POST['ville'], $_POST['telephone'], crypt($_POST['confirmpassword'], $salt), $_POST['bacserie'], $_POST['mention'], $_POST['suivicours'], $_POST['planchage'], $_POST['total']];
			}

			$file[0] = implode("2019paces", $donnees);
			$contenu = "";
			foreach ($file as $i)
				$contenu .= $i."\n";

			unlink("bddusers/".$_COOKIE['PACES-DEMOCRITE']);
			fputs(fopen("bddusers/".$_COOKIE['PACES-DEMOCRITE'], "w"), $contenu);
			echo 0;
		}
	}

	if($_POST['action'] == 5){
		$donnees = $_POST['nom'].$salt.$_POST['prenom'].$salt.$_POST['mail'].$salt.$_POST['sujet'].$salt.$_POST['message'].$salt.time();
		fputs(fopen("contact/".time(), "w"), $donnees);
	}
?>