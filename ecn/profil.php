<?
	if (!isset($_COOKIE['ECN-SUIVI-nom']) || !isset($_COOKIE['ECN-SUIVI-var']))
		header("Location: /ecn");
	else {
		$identite = $_COOKIE['ECN-SUIVI-nom'];
		$user = $_COOKIE['ECN-SUIVI-var'];

		$f = fopen("bddusers/".$user, "r");
		$donneeslecture = explode("2019ecn", fgets($f));
		$line2 = explode("2019ecn", trim(fgets($f)));
		$line1 = explode("2019ecn", trim(fgets($f)));
		fclose($f);

		// PARTIE LEVEL
		$essai = false;
		$expired = false;
		$jouressai = 7;
		$periode = round((time() - $line1[1])/86400, 0, PHP_ROUND_HALF_DOWN);
		// PARTIE SI PAS PAYE
		if (intval($line1[0]) == -1){
			$essai = true;
			if ($periode >= $jouressai)
				$expired = true;
		}
		//////////////////////////////////////////

		$nbrelupermodule = [[0, 20], [0, 32], [0, 26], [0, 36], [0, 26], [0, 39], [0, 37], [0, 69], [0, 31], [0, 9], [0, 37]];
		$nbitemsfiches = 0;
		
		$tabrelu = array();
		$c = 0;
		for ($a = 0; $a < 11; $a++){
			for ($b = 0; $b < $nbrelupermodule[$a][1]; $b++){
				$d = explode("777ecn", $donneeslecture[$c]);
				array_push($tabrelu, intval(trim($d[1])));
				if (intval(trim($d[1])) >= 1)
					$nbrelupermodule[$a][0]++;
				if(intval(trim($d[0])) == 1)
					$nbitemsfiches++;
				$c++;
			}
		}

		## SCORE PERSO
		$totalrelu = 0;
		$total = 0;
		foreach($nbrelupermodule as $i){
			$totalrelu += $i[0];
			$total += $i[1];
		}
	}
?>
<html>
	<head>
		<title>Démocrite ECN - <?echo $identite; ?></title>
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
		<meta name="viewport" content="width=device-width, initial-scale=0.75">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- ICONES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- GOOGLE ANALYTICS -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151030460-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());  gtag('config', 'UA-151030460-1');</script>
	</head>
	<style>
		body {
			margin: 0;
			padding: 0;
			background: whitesmoke;
		}
	</style>
	<body>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<?include_once("header.php");?>

		<style>
			body {
				margin: 0;
				padding: 0;
				background: white;
			}
			.test {
				width: 75px;
				height: 75px;
				top: -1.5rem;
				left: -1.5rem;
				}
		</style>
		<?

		if ($essai && $expired){
			?>
		<div class="col mt-4">
			<ul class="list-group">
				<li class="list-group-item bg-dark text-white h5">Informations</li>
				<li class="list-group-item list-group-item-warning">Votre période d'essai est terminé. Veuillez le mettre à niveau pour accéder à toutes les fontionnalités du site.</li>
			</ul>
		</div>
			<?}?>
		<div class="col">
			<ul class="list-group mt-4 mb-4">
				<li class="list-group-item bg-dark text-white h5">Votre avancement global</li>
				<li class="list-group-item">
					<h5>Item(s) relu(s) : </h5>
					<?
					
					?>
					<div class="progress mt-3">
						<div class="progress-bar text-center text-dark bg-warning" role="progressbar" style="width: <? echo (($totalrelu/$total)*100); ?>%" aria-valuemin="0" aria-valuemax="100"><? echo ($totalrelu)." items relus sur ".$total; ?></div>
					</div>
				</li>
				<li class="list-group-item">
					<h5>Item(s) fiché(s) : </h5>
					<div class="progress mt-3">
						<div class="progress-bar text-center text-dark bg-warning" role="progressbar" style="width: <? echo (($nbitemsfiches/$total)*100); ?>%" aria-valuemin="0" aria-valuemax="100"><? echo ($nbitemsfiches)." items fichés sur ".$total; ?></div>
					</div>
				</li>
				<!--<li class="list-group-item">
					<h5>Classement par rapport à votre promo :</h5>
					<h5 class="d-flex align-items-center justify-content-center" id="classement"></h6>
				</li>
				<script>
				function classement(){
					$("#classement").html("<span class='spinner-grow mr-4'></span>Chargement...");
					$.post(
						'functions.php', {action: 9, nb: <?echo $totalrelu;?>},
						function (data){
							donnees = data.split("2019ecn");
							$("#classement").html("Classement : "+donnees[0]+"ème /"+donnees[1]);
						},
						'text'
					);
				}
				classement();
				</script>
				-->
			</ul>

			<ul class="list-group mb-4">
				<li class="list-group-item bg-dark text-white h5">Informations générales</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col"><input class="form-control" value="<?echo $line2[0];?>" id="profilnom" placeholder="Nom"></div>
						<div class="col"><input class="form-control" value="<?echo $line2[1];?>" id="profilprenom" placeholder="Prénom"></div>
						<div class="col"><input class="form-control" value="<?echo $line2[4];?>" id="profilmail" placeholder="E-mail"></div>
					</div>
				</li>
				<li class="list-group-item">
					<input class="form-control" placeholder="Mot de passe" id="profilmdp">
				</li>
				<li class="list-group-item">
					<div class="input-group">
						<div class="input-group-prepend">
							<label class="input-group-text material-icons">school</label>
						</div>
						<select class="custom-select" id="profilpromo">
							<option <?if(strpos($line2[5], "DFGSM2") !== false) echo "selected"; ?>>DFGSM2</option>
							<option <?if(strpos($line2[5], "DFGSM3") !== false) echo "selected"; ?>>DFGSM3</option>
							<option <?if(strpos($line2[5], "DFASM1") !== false) echo "selected"; ?>>DFASM1</option>
							<option <?if(strpos($line2[5], "DFASM2") !== false) echo "selected"; ?>>DFASM2</option>
							<option <?if(strpos($line2[5], "DFASM3") !== false) echo "selected"; ?>>DFASM3</option>
						</select>
					</div>
				</li>
				<li class="list-group-item">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="ville"><span class="material-icons" id="spanlocation">my_location</span></label>
						</div>
						<select class="custom-select" id="profilville">
							<?
							$villes = ["Sorbonne Université (ex UPMC)","Université d'Angers","Université de Aix Marseille","Université de Bordeaux","Université de Bourgogne","Université de Brest","Université de Caen","Université de Clermont Auvergne","Université de Franche-Comté","Université de Grenoble - UGA","Université de la Réunion","Université de Lille","Université de Lille Catho","Université de Limoges","Université de Lorraine","Université de Lyon","Université de Montpellier","Université de Nantes","Université de Nice-Sophia Antipolis","Université de Paris 11 - Sud","Université de Paris 12 - Créteil","Université de Paris 13 - Bobigny","Université de Paris 5 - Descartes","Université de Paris  7 - Diderot","Université de Picardie - Jules Verne","Université de Poitiers","Université de Reims","Université de Rennes 1","Université de Rouen","Université de Saint-Etienne","Université des Antilles et de la Guyane","Université de Strasbourg","Université de Toulouse","Université de Tours","Université de Versailles - UVSQ"];
							foreach($villes as $i){
								if (strpos(trim($line2[6]), $i) !== false)
									echo "<option selected='selected'>$i</option>";
								else echo "<option>$i</option>";
							}
							?>
						</select>
					</div>
				</li>
				<li class="list-group-item"><button class="btn btn-warning d-flex align-items-center justify-content-center" id="profilsave"><span id='profilspan'></span>Enregistrer</button></li>
			</ul>
			<ul class="list-group mb-4">
				<li class="list-group-item bg-dark text-white h5">Liens utiles</li>
				<li class="list-group-item">
					<div class="col h5">Les référentiels PDF</div>
					<div class="col">
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/chirurgie-maxillo-faciale-et-stomatologie/liste-2.html" target="_blank">Chirurgie maxillofaciale et stomatologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/dermatologie/liste-2.html" target="_blank">Dermatologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.sfendocrino.org/article/667/polycopie-des-enseignants-en-endocrinologie-diabete-et-maladies-metaboliques-3eme-edition-2015" target="_blank">Endocrinologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.seformeralageriatrie.org/livregeriatriecneg" target="_blank">Gériatrie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/gynecologie-et-obstetrique/liste-2.html" target="_blank">Gynécologie obstétrique</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/hematologie/liste-2.html" target="_blank">Hématologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="https://www.snfge.org/content/abrege-dhepato-gastro-enterologie-et-de-chirurgie-digestive" target="_blank">Hépatologie gastrologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://wiki.side-sante.fr/doku.php?id=sides:ref-trans:imagerie:start" target="_blank">Imagerie médicale </button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/immunologie/poly-immunologie.pdf" target="_blank">Immunologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/immunologie/liste-2.html" target="_blank">Immunopathologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://cuen.fr/manuel/" target="_blank">Néphrologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="https://www.cen-neurologie.fr/deuxieme-cycle" target="_blank">Neurologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/nutrition/liste-2.html" target="_blank">Nutrition</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/ophtalmologie/liste-2.html" target="_blank">Ophtalmologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/orl/liste-2.html" target="_blank">ORL</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.sofcot.fr/content/download/15156/112462/version/1/file/Reussir_l%27iECN_Orthopedie_Traumatologie_Ellipses_2018.pdf" target="_blank">Orthopédie, traumatologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://cemv.vascular-e-learning.net/poly/" target="_blank">Pathologies vasculaires</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://campus.cerimes.fr/pediatrie/liste-2.html" target="_blank">Pédiatrie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.infectiologie.com/fr/ecnpilly-edition-2018-disponible-en-librairie.html" target="_blank">Le Pilly</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://cep.splf.fr/enseignement-du-deuxieme-cycle-dcem/referentiel-national-de-pneumologie/" target="_blank">Pneumologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.asso-aesp.fr/wp-content/uploads/2014/11/Referentiel_2eme.pdf" target="_blank">Psychatrie et addictologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.lecofer.org/index.php?rub=2cycle&ssrub=items" target="_blank">Rumathologie</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.cnerea.fr/fr/livre-deuxieme-cycle-ecn.html" target="_blank">Urgence, Réanimation, défaillances viscérales aiguës</button>
						<button class="btn btn-primary mt-1 mr-2 ml-2 mb-1" href="http://www.urofrance.org/congres-et-formations/formation-initiale/referentiel-du-college.html" target="_blank">Urologie</button>
						<button class="btn btn-secondary mt-1 mr-2 ml-2 mb-1">Anesthésie Réanimation (non disponible)</button>
						<button class="btn btn-secondary mt-1 mr-2 ml-2 mb-1">Cardiologie (non disponible)</button>
						<button class="btn btn-secondary mt-1 mr-2 ml-2 mb-1">Médecine physique et réadaptation (non disponible)</button>
					</div>
				</li>
			</ul>
			<script>
				$("button").click(function(){
					if ($(this).hasClass("btn-primary mt-1 mr-2 ml-2 mb-1"))
						window.open($(this).attr("href"), "_blank");
				});
				$("#profilsave").click(function(){
					bad = false;
					if ($("#profilnom").val().length == 0){
						bad = true;
						$("#profilnom").addClass('btn-outline-danger');
					} else $("#profilnom").removeClass('btn-outline-danger');

					if ($("#profilprenom").val().length == 0){
						bad = true;
						$("#profilprenom").addClass('btn-outline-danger');
					} else $("#profilprenom").removeClass('btn-outline-danger');

					if ($("#profilmail").val().length == 0){
						bad = true;
						$("#profilmail").addClass('btn-outline-danger');
					} else $("#profilmail").removeClass('btn-outline-danger');

					if (!bad){
						var nom = $("#profilnom").val(), prenom = $("#profilprenom").val(), mail = $("#profilmail").val(), mdp = $("#profilmdp").val(), ville = $("#profilville").children('option:selected').html(), promo = $("#profilpromo").children('option:selected').html();
						$("#profilspan").addClass("spinner-grow mr-4");
						$("#profilsave").attr("disabled", true);
						$.post(
							'functions.php',
							{action: 8, nom: nom, prenom: prenom, mail: mail, mdp: mdp, promo: promo, ville: ville},
							function (data){
								alert("Changement enregistré !");
								$("#profilspan").removeClass("spinner-grow mr-4");
								$("#profilsave").attr("disabled", false);
							},
							'text'
						);
					}
				})
			</script>

			<?if ($essai){?>
				<!-- PAYPAL -->
				<script  src="https://www.paypal.com/sdk/js?client-id=AXvKMfvS4lAIuop8bSUYw7CF4KudlwvRuO_-av5RyD_pLpAimO4xnjy_lVlmvxuanMvHaLYMfZQV3uPv&currency=EUR"></script>
				<!-- -->
				<ul class="list-group mb-4">
					<li class="list-group-item bg-dark text-white h5">Mettez à niveau votre compte, prix unique : 5,00€</li>
					<li class="list-group-item d-flex align-items-center justify-content-center"><span id="btnpaypal"></span></li>
				</ul>
				<script>
					paypal.Buttons({
						createOrder: function(data, actions){
							return actions.order.create({
								purchase_units: [{amount: { value: '5.00'}}]
							});
						},
						onApprove: function(data, actions) {
							return actions.order.capture().then(function(details) {
								alert('Votre paiement a bien été enregistré. Merci pour votre achat.');
								$.post(
									'functions.php',
									{action: 7},
									function(data){
										window.location = "/ecn/profil?paiement=fait";
									}
								);
							});
						}
					}).render('#btnpaypal');
				</script>
			<?}?>
		</div>
		<script>
			$("#sendcontact").click(function(){
				bad = false;

				if ($("#messagecontact").val().length <= 10){
					bad = true;
					$("#messagecontact").addClass('btn-outline-danger')

				} else $("#messagecontact").removeClass("btn-outline-danger");

				if(!bad){
					$("#spancontact").addClass("spinner-grow mr-4");
					$("#sendcontact").attr("disabled", true);
					var imessage = $("#messagecontact").val().replace(/\n/g, "<br>");
					$.post(
						'functions.php',
						{action: 6, 
							nom: $("#nomcontact").val(),
							prenom: $("#prenomcontact").val(),
							mail: $("#mailcontact").val(),
							sujet: $("#sujetcontact").children("option:selected").html(),
							message: imessage},
						function(data){
							alert("Message envoyé avec succès. Vous recevrez une réponse sous peu.");
							$("#messagecontact").val('');
							$("#spancontact").removeClass("spinner-grow mr-4");
							$("#sendcontact").attr("disabled", false);
						},
						'text'
					);
				}

			})
		</script>
	</body>
</html>