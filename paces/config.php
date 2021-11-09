<?
	$prix = [18, 45, 40, 40, 25, 45, 20, 45, 80, 90, 30, 65, 70, 50, 30, 30, 55, 60, 35, 60, 20, 30, 30, 30, 35, 40, 25, 40, 90, 15, 10, 25, 30, 40, 55, 55, 10, 20, 30, 15, 10];
	
	if (isset($_POST['action']) && $_POST['action'] == 1){
		fputs(fopen($_POST['id'], "w"), trim($_POST['line1'])."\n".trim($_POST['line2'])."\n".trim($_POST['line3'])."\n".trim($_POST['line4']));
	}
	// PAIEMENT SUCCESS
	if (isset($_POST['action']) && $_POST['action'] == 2){
		$id = $_POST['token'];
		$f = fopen($id, "r");
		$line1 = explode("2019paces", trim(fgets($f))); $line2 = explode("2019paces", trim(fgets($f))); $line3 = explode("2019paces", trim(fgets($f))); $line4 = trim(fgets($f));
		fclose($f);
		unlink($id);

		$total = 0; $totalttc = 0; $ouinon = "non";
		foreach($line2 as $i)
			$total += intval($i);

		if (intval($line4) == 1){
			$ouinon = "oui";
			$totalttc += 7;
		}

		$produits = "";
		foreach($line1 as $i)
			$produits .= $i."<br>";

		$totalttc += $total;

		$nom = $line3[0];
		$prenom = $line3[1];
		$ddn = $line3[2];
		$adresse = $line3[3];
		$codepostale = $line3[4];
		$ville = $line3[5];
		$telephone = $line3[6];
		$email = $line3[7];

		function sanitize_my_email($field) {
			$field = filter_var($field, FILTER_SANITIZE_EMAIL);
			if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
				return true;
			} else {
				return false;
			}
		}

		$to_email = 'contact@revision-medecine.fr';
		$subject = 'COMMANDE : '.$nom.' '.$prenom.' ('.date("d/m/Y H:i:s").')';
		$message = '<b>NOM : '.$nom.'</b><br>
					<b>PRENOM : '.$prenom.'</b><br>
					<b>DATE DE NAISSANCE : '.$ddn.'</b><br>
					<b>E-MAIL : '.$email.'</b><b>TELEPHONE : '.$telephone.'</b><br>
					<b>ADRESSE : '.$adresse.' </b><b>CODE POSTALE : '.$codepostale.' </b><b>VILLE : '.$ville.'</b><br>
					<b>PRIX PAYE : '.$totalttc.' </b><b>RETRAIT : '.$ouinon.'</b><br>
					<b>PRODUITS : <br>'.$produits;
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

	if (isset($_POST['action']) && $_POST['action'] == 3){
		$id = $_POST['id'];
		unlink($id);
	}
?>