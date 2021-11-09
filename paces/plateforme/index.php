<?
	$salt = "2019paces";
	$jouressai = 7;
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");
	else {
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$f = fopen("../bddusers/".$username, "r");
		$lines = array();
		while (($line = fgets($f)) !== false)
			array_push($lines, trim($line));
		fclose($f);
		$line1 = explode($salt, $lines[0]); $line2 = $lines[1]; $line3 = $lines[2];

		$identite = array();
		foreach($line1 as $i)
			array_push($identite, $i);
		$offre = array();

		$expired = false;
		if ($identite[11] == 0){
			$fin = $line3+$jouressai*24*3600;
			if (time() >= $fin)
				$expired = true;
		}

		/** COURS ACHETES **/
		$listecoursachetes = array();
		if (file_exists("../bddusers/cours/".$username)){
			$listecoursachetes = explode("---", trim(fgets(fopen("../bddusers/cours/".$username, "r"))));
		}

		$nbcoursdispo = 0;
		$f = fopen("listecoursfiche", "r");
		while(($a = fgets($f)) !== false)
			$nbcoursdispo++;
		fclose($f);

		$lastconnexion = "";
		$f = fopen("../bddusers/historique/$username.co", "r");
		$lastconnexion = fgets($f); $lastconnexion = fgets($f);

	}
?>
<html>
	<head>
		<title>D-Learning - Profil</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.75">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- ICONES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- GOOGLE ANALYTICS -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151030460-2"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-151030460-2');</script>
		
	</head>
	<style>
		body {
			margin: 0;
			padding: 0;
			background: whitesmoke;
		}
	</style>
	<body class="bg-light">
		<style>
			.nav-link {
				color: white !important;
			}

			.nav-link:hover {
				color: rgba(255, 255, 255, 0.5) !important;
			}

			#social:hover {
				cursor: pointer;
			}

			.centre {
				display: flex;
				align-items: center;
				justify-content: center;
			}

		</style>

		<?include_once "header.php";?>
		<?include_once "abonnementsuivicours.php";?>

		<div class="container-fluid mt-4 mb-4" id="desktop">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white d-flex justify-content-center"><h3 class="font-weight-bold">Votre profil</h3></li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 centre"><span class="material-icons mr-4">account_circle</span>Informations de compte</li>
					<li class="list-group-item list-group-item-warning small small centre">Dernière connexion : <?echo $lastconnexion; ?></li>
					<li class="list-group-item">
						<div class="row">
							<div class="col"><input class="form-control" id="profilnom" type="text" placeholder="Nom" value="<?echo $identite[0];?>"></div>
							<div class="col"><input class="form-control" id="profilprenom" type="text" placeholder="Prenom" value="<?echo $identite[1];?>"></div>
							<div class="col"><input class="form-control" id="profilddn" type="date" placeholder="Date de Naissance" value="<?echo $identite[2];?>"></div>
							<div class="col"><input class="form-control" id="profilmail" type="mail" placeholder="E-mail" value="<?echo $identite[3];?>"></div>
						</div>
					</li>
					<li class="list-group-item"><input class="form-control" id="profiladresse" type="text" placeholder="Adresse" value="<?echo $identite[4];?>"></li>
					<li class="list-group-item">
						<div class="row">
							<div class="col"><input class="form-control" id="profilcodepostale" type="number" placeholder="Code Postale" value="<?echo $identite[5];?>"></div>
							<div class="col"><input class="form-control" id="profilville" type="text" placeholder="Ville" value="<?echo $identite[6];?>"></div>
							<div class="col"><input class="form-control" id="profiltelephone" type="text" placeholder="Téléphone" value="<?echo $identite[7];?>"></div>
						</div>
					</li>
					<li class="list-group-item"><input class="form-control" id="profilancienmdp" type="password" placeholder="Mot de passe"></li>
					<li class="list-group-item">
						<div class="row">
							<div class="col"><h4 class="font-weight-bold">Changer de mot de passe : </h4></div>
							<div class="col"><input class="form-control" id="profilnvmdp" type="password" placeholder="Nouveau mot de passe"></div>
							<div class="col"><input class="form-control" id="profilconfirmmdp" type="password" placeholder="Confirmez le nouveau mot de passe"></div>
						</div>
					</li>
					<li class="list-group-item"><button id="saveprofil" class="btn btn-warning d-flex align-items-center justify-content-center"><span class="material-icons mr-3">cloud_upload</span>Enregistrer</button></li>
				</ul>
			</div>
			
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 centre"><span class="material-icons mr-4">assessment</span>Votre offre souscrite/Mettre à niveau</li>
					<li class="list-group-item"><b>Suivi de cours : </b>
						<?
						if ($identite[11] == 0){
							if ($expired)
								$color = 'danger';
							else $color = 'success';
							echo "<button class='btn btn-$color mr-4'>Essai gratuit</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements1'>Semestre 1 (7€)</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements2'>Semestre 2 (10€)</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
							if ($expired){
								echo "<button class='btn btn-danger float-right'>Expiré</button>";
							}
						}
						else if ($identite[11] == 1){
							echo "<button class='btn btn-success mr-3'>Semestre 1</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements2'>Semestre 2 (10€)</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
						}
						else if ($identite[11] == 2){
							echo "<button class='btn btn-success'>Semestre 2</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
						}
						else if ($identite[11] == 3){
							echo "<button class='btn btn-success'>Annuel</button>";
						}
						?>
					</li>
					<li class="list-group-item"><b>Planchages : </b>
						<?
						if ($identite[12] == 0){
							echo "<button class='btn btn-success mb-4'>Essai gratuit</button><br><i>Mettre à niveau :</i> ";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Avec Concours : Semestre 1 (200€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchages2C'>Avec Concours : Semestre 2 (250€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Avec Concours : Annuel (400€)</button>";

							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementoffre'>Sans concours : Semestre 1 (60€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchages2SC'>Sans concours : Semestre 2 (180€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchagesASC'>Sans concours : Annuel (230€)</button>";

							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Semestre 1 (70€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Semestre 2 (70€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Annuel (130€)</button>";
						}
						else if ($identite[12] == 1){
							echo "<button class='btn btn-success'>Semestre 1</button>";
						}
						else if ($identite[12] == 2){
							echo "<button class='btn btn-success'>Semestre 2</button>";
						}
						else if ($identite[12] == 3){
							echo "<button class='btn btn-success'>Annuel</button>";
						}
						else if ($identite[12] == 4){
							echo "<button class='btn btn-success'>Offre Révision </button><span class='float-right'><button class='btn btn-danger'>Expire 25 Janvier 2020</button></span>";
						}
						else if ($identite[12] == 5){
							echo "<button class='btn btn-success'>Sans concours : Semestre 2</button>";
						}
						else if ($identite[12] == 6){
							echo "<button class='btn btn-success'>Sans concours : Annuel</button>";
						}
						else if ($identite[12] == 7){
							echo "<button class='btn btn-success'>Concours : Semestre 1</button>";
						}
						else if ($identite[12] == 8){
							echo "<button class='btn btn-success'>Concours : Semestre 2</button>";
						}
						else if ($identite[12] == 9){
							echo "<button class='btn btn-success'>Concours : Annuel</button>";
						}
						?>
					</li>
					<li class="list-group-item"><b>Cours achetés : </b>
						<?if ($identite[13] == 0){?>
							<? echo (count($listecoursachetes)-1)." cours/fiches achetés sur $nbcoursdispo cours/fiches disponibles."; ?><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 15 Février 2020</button></span>
						<?} else if ($identite[13] == 1){?>
							<button class="btn btn-primary">Cours Semestre 1</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 15 Février 2020</button></span>
						<?} else if ($identite[13] == 2){?>
							<button class="btn btn-primary">Cours Semestre 2</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 30 Juin 2020</button></span>
						<?} else if ($identite[13] == 3){?>
							<button class="btn btn-primary">Cours Annuel</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 30 Juin 2020</button></span>
						<?}?>
					</li>
				</ul>
			</div>
		</div>


		<!-- VUE MOBILE -->
		<div id="mobile">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white d-flex justify-content-center"><h3 class="font-weight-bold">Votre profil</h3></li>
				</ul>
			</div>
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 centre"><span class="material-icons mr-4">account_circle</span>Informations de compte</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col mb-3"><input class="form-control" id="profilnom" type="text" placeholder="Nom" value="<?echo $identite[0];?>"></div>
							<div class="col mb-3"><input class="form-control" id="profilprenom" type="text" placeholder="Prenom" value="<?echo $identite[1];?>"></div>
						</div>
						<div class="row">
							<div class="col mb-3"><input class="form-control" id="profilddn" type="date" placeholder="Date de Naissance" value="<?echo $identite[2];?>"></div>
							<div class="col mb-3"><input class="form-control" id="profilmail" type="mail" placeholder="E-mail" value="<?echo $identite[3];?>"></div>
						</div>
					</li>
					<li class="list-group-item"><input class="form-control" id="profiladresse" type="text" placeholder="Adresse" value="<?echo $identite[4];?>"></li>
					<li class="list-group-item">
						<div class="row">
							<div class="col mb-3"><input class="form-control" id="profilcodepostale" type="number" placeholder="Code Postale" value="<?echo $identite[5];?>"></div>
							<div class="col mb-3"><input class="form-control" id="profilville" type="text" placeholder="Ville" value="<?echo $identite[6];?>"></div>
						</div>
						<div class="row">
							<div class="col mb-3"><input class="form-control" id="profiltelephone" type="text" placeholder="Téléphone" value="<?echo $identite[7];?>"></div>
						</div>
					</li>
					<li class="list-group-item"><input class="form-control" id="profilancienmdp" type="password" placeholder="Mot de passe"></li>
					<li class="list-group-item">
						<div class="col">
							<div class="col mb-3"><h4 class="font-weight-bold text-center">Changer de mot de passe</h4></div>
							<div class="col mb-3"><input class="form-control" id="profilnvmdp" type="password" placeholder="Nouveau mot de passe"></div>
							<div class="col mb-3"><input class="form-control" id="profilconfirmmdp" type="password" placeholder="Confirmez le nouveau mot de passe"></div>
						</div>
					</li>
					<li class="list-group-item centre"><button id="saveprofil" class="btn btn-warning d-flex align-items-center justify-content-center"><span class="material-icons mr-3">cloud_upload</span>Enregistrer</button></li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 centre"><span class="material-icons mr-4">assessment</span>Votre offre souscrite/Mettre à niveau</li>
					<li class="list-group-item"><b>Suivi de cours : </b>
						<?
						if ($identite[11] == 0){
							if ($expired)
								$color = 'danger';
							else $color = 'success';
							echo "<button class='btn btn-$color mr-4 mb-3'>Essai gratuit</button><br><i>Mettre à niveau : </i>";
							echo "<div class='centre'>";
								echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements1'>Semestre 1 (7€)</button>";
								echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements2'>Semestre 2 (10€)</button>";
								echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
							echo "</div>";
							if ($expired){
								echo "<button class='btn btn-danger float-right'>Expiré</button>";
							}
						}
						else if ($identite[11] == 1){
							echo "<button class='btn btn-success mr-3'>Semestre 1</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiements2'>Semestre 2 (10€)</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
						}
						else if ($identite[11] == 2){
							echo "<button class='btn btn-success'>Semestre 2</button>";
							echo "<button class='btn btn-warning mr-3' data-toggle='modal' data-target='#modalpaiementannuel'>Annuel (15€)</button>";
						}
						else if ($identite[11] == 3){
							echo "<button class='btn btn-success'>Annuel</button>";
						}
						?>
					</li>
					<li class="list-group-item"><b>Planchages : </b>
						<?
						if ($identite[12] == 0){
							echo "<button class='btn btn-success mb-4'>Essai gratuit</button><br><i>Mettre à niveau :</i> ";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Avec Concours : Semestre 1 (200€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchages2C'>Avec Concours : Semestre 2 (250€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Avec Concours : Annuel (400€)</button>";

							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementoffre'>Sans concours : Semestre 1 (60€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchages2SC'>Sans concours : Semestre 2 (180€)</button>";
							echo "<button class='btn btn-warning mr-3 mb-2' data-toggle='modal' data-target='#modalpaiementplanchagesASC'>Sans concours : Annuel (230€)</button>";

							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Semestre 1 (70€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Semestre 2 (70€)</button>";
							echo "<button class='btn btn-secondary mr-3 mb-2'>Concours uniquement Annuel (130€)</button>";
						}
						else if ($identite[12] == 1){
							echo "<button class='btn btn-success'>Semestre 1</button>";
						}
						else if ($identite[12] == 2){
							echo "<button class='btn btn-success'>Semestre 2</button>";
						}
						else if ($identite[12] == 3){
							echo "<button class='btn btn-success'>Annuel</button>";
						}
						else if ($identite[12] == 4){
							echo "<button class='btn btn-success'>Offre Révision </button><span class='float-right'><button class='btn btn-danger'>Expire 25 Janvier 2020</button></span>";
						}
						else if ($identite[12] == 5){
							echo "<button class='btn btn-success'>Sans concours : Semestre 2</button>";
						}
						else if ($identite[12] == 6){
							echo "<button class='btn btn-success'>Sans concours : Annuel</button>";
						}
						else if ($identite[12] == 7){
							echo "<button class='btn btn-success'>Concours : Semestre 1</button>";
						}
						else if ($identite[12] == 8){
							echo "<button class='btn btn-success'>Concours : Semestre 2</button>";
						}
						else if ($identite[12] == 9){
							echo "<button class='btn btn-success'>Concours : Annuel</button>";
						}
						?>
					</li>
					<li class="list-group-item"><b>Cours achetés : </b>
						<?if ($identite[13] == 0){?>
							<? echo (count($listecoursachetes)-1)." cours/fiches achetés sur $nbcoursdispo cours/fiches disponibles."; ?><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 15 Février 2020</button></span>
						<?} else if ($identite[13] == 1){?>
							<button class="btn btn-primary">Cours Semestre 1</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 15 Février 2020</button></span>
						<?} else if ($identite[13] == 2){?>
							<button class="btn btn-primary">Cours Semestre 2</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 30 Juin 2020</button></span>
						<?} else if ($identite[13] == 3){?>
							<button class="btn btn-primary">Cours Annuel</button><span class='float-right'><button class='btn btn-success'>Disponible jusqu'au 30 Juin 2020</button></span>
						<?}?>
					</li>
				</ul>
			</div>

		</div>
		<!-- VUE MOBILE -->

		<script>
			if (/Mobi|Android/i.test(navigator.userAgent)) {
			    //alert("La navigation sur téléphone portable n'est pas optimisée. Consultez notre site internet sur un ordinateur pour une meilleure expérience d'utilisation.");
			    $("#desktop").empty();
			}
			else {
				$("#mobile").empty();
			}
		</script>

		<script>
			$("#saveprofil").click(function(){
				bad = false;
				if ($("#profilancienmdp").val().length == 0){
					$("#profilancienmdp").addClass("border-danger");
					bad = true;
				} else {
					$("#profilancienmdp").removeClass("border-danger");

					if ($("#profilnom").val().length == 0){
						$("#profilnom").addClass("border-danger");
						bad = true;
					} else $("#profilnom").removeClass('border-danger');

					if ($("#profilprenom").val().length == 0){
						$("#profilprenom").addClass("border-danger");
						bad = true;
					} else $("#profilprenom").removeClass('border-danger');

					if ($("#profilddn").val().length == 0){
						$("#profilddn").addClass("border-danger");
						bad = true;
					} else $("#profilddn").removeClass('border-danger');

					if ($("#profilmail").val().length == 0){
						$("#profilmail").addClass("border-danger");
						bad = true;
					} else $("#profilmail").removeClass('border-danger');

					if ($("#profiladresse").val().length == 0){
						$("#profiladresse").addClass("border-danger");
						bad = true;
					} else $("#profiladresse").removeClass('border-danger');

					if ($("#profilcodepostale").val().length == 0){
						$("#profilcodepostale").addClass("border-danger");
						bad = true;
					} else $("#profilcodepostale").removeClass('border-danger');

					if ($("#profilville").val().length == 0){
						$("#profilville").addClass("border-danger");
						bad = true;
					} else $("#profilville").removeClass('border-danger');

					if ($("#profiltelephone").val().length == 0){
						$("#profiltelephone").addClass("border-danger");
						bad = true;
					} else $("#profiltelephone").removeClass('border-danger');

					if ($("#profilnvmdp").val().length > 0 && $("#profilconfirmmdp").val().length == 0){
						$("#profilconfirmmdp").addClass("border-danger");
						bad = true;
					} else if($("#profilnvmdp").val() != $("#profilconfirmmdp").val()){
						$("#profilnvmdp").addClass("border-danger");
						$("#profilconfirmmdp").addClass("border-danger");
						bad = true;
					}
					else if ($("#profilnvmdp").val() == $("#profilconfirmmdp").val() && $("#profilnvmdp").val().length > 0){
						if ($("#profilnvmdp").val().length < 5){
							$("#profilnvmdp").addClass("border-danger");
							$("#profilconfirmmdp").addClass("border-danger");
							bad = true;
						}
						else {
							$("#profilnvmdp").removeClass("border-danger");
							$("#profilconfirmmdp").removeClass("border-danger");
						}
					}

					if(!bad){
						if ($("#profilnvmdp").val().length == 0){
							$.post(
								'../functions.php',
								{action: 4, nom: $("#profilnom").val(), prenom: $("#profilprenom").val(), ddn: $("#profilddn").val(), mail: $("#profilmail").val(), adresse: $("#profiladresse").val(), codepostale: $("#profilcodepostale").val(), ville: $("#profilville").val(), telephone: $("#profiltelephone").val(), password: $("#profilancienmdp").val(), confirmpassword: -1},
								function (data){
									if (parseInt(data) == -1)
										alert("Mauvais mot de passe.");
									else {
										alert('Changements enregistrés.');
									}
								}, 'text'
							);	
						}
						else {
							$.post(
								'../functions.php',
								{action: 4, nom: $("#profilnom").val(), prenom: $("#profilprenom").val(), ddn: $("#profilddn").val(), mail: $("#profilmail").val(), adresse: $("#profiladresse").val(), codepostale: $("#profilcodepostale").val(), ville: $("#profilville").val(), telephone: $("#profiltelephone").val(), password: $("#profilancienmdp").val(), confirmpassword: $("#profilconfirmmdp").val()},
								function (data){
									if (parseInt(data) == -1)
										alert("Mauvais mot de passe.");
									else {
										alert('Changements enregistrés.');
									}
								}, 'text'
							);	
						}
					}
				}
			})
		</script>

		<?include_once "footer.php";?>
	</body>
</html>