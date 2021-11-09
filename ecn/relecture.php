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
		$titremodule = ["Apprentissage de l'exercice médical", "De la conception à la naissance", "Maturation et vulnérabilité", "Perception, système nerveux, revêtement cutané", "Handicap, vieillissement, dépendance, douleurs", "Maladies transmissibles, risque sanitaire, santé au travail", "Inflammation, immunopathologie, poumon, sang", "Circulation, métabolisme", "Onco hématologie", "Le bon usage du médicament et thérapeutique non médicamenteuse", "Urgence et défaillance viscérales aiguës"];
		$couleurs = ["#007bff","#6610f2","#6f42c1","#e83e8c","#dc3545","#fd7e14","#ffc107","#28a745","#20c997","#17a2b8","#17a2b8"];
		$txtcouleurs = ["#B4D7FD","#B193FB","#B39DDD","#F4A9CB","#ED9CA4","#FEBF8A","#FDE18B","#A2E7B2","#93F0D5","#92E9F7","#BDF1FA"];
		
		$tabrelu = array();
		$c = 0;
		for ($a = 0; $a < 11; $a++){
			for ($b = 0; $b < $nbrelupermodule[$a][1]; $b++){
				$d = explode("777ecn", $donneeslecture[$c]);
				array_push($tabrelu, intval(trim($d[1])));
				if (intval(trim($d[1])) >= 1)
					$nbrelupermodule[$a][0]++;
				$c++;
			}
		}
		$listeitem = explode("2019ecn", trim(fgets(fopen("listeitem", "r"))));
		array_splice($listeitem, 0, 1);
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
		<div class="col">
			<!-- CARDS UE PROGRESSIONS -->
			<div class="row ml-4 mt-4 mb-4 d-flex align-items-center justify-content-center">
				<?
				for ($a= 0; $a < 11; $a++){
					?>
				<div class="card shadow-sm position-relative mt-4 mb-4 mr-5" style="width: 20rem;">
					<div class="test shadow-sm rounded-circle d-flex justify-content-center align-items-center position-absolute bg-secondary">
					<span class="text-white material-icons text-dark" style="font-size: 3rem;">emoji_events</span>
					</div>
					<div class="card-body bg-light text-muted">
						<h5 class="card-text d-flex justify-content-center align-items-center">Module <?echo ($a+1);?></h5>
						<div class="progress mt-3">
							<div id="pUE1" class="progress-bar text-center text-dark bg-secondary" role="progressbar" style="width: <? echo (($nbrelupermodule[$a][0]/$nbrelupermodule[$a][1])*100); ?>%" aria-valuemin="0" aria-valuemax="100"><? echo ($nbrelupermodule[$a][0])." items relus sur ".$nbrelupermodule[$a][1]; ?></div>
						</div>
					</div>
					<div class="card-footer text-center text-muted" >
						<a class="h6 d-flex justify-content-center align-items-center"><?echo $titremodule[$a];?></a>
					</div>
				</div>
					<?
				}

				?>
			</div>
		</div>
			<?
		}
		else if ($essai && !$expired || !$essai){

		$c = 0;
		for ($a = 0; $a < 11; $a++){
		?>
		<div class="modal fade" id="module<?echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?echo $titremodule[$a]; ?></h5>
					</div>
					<div class="modal-body">
						<ul class="list-group">
							<?
								if ($nbrelupermodule[$a][0] == 0){
									echo "<li class='list-group-item list-group-item-danger'>Aucun item relu dans ce module.</li>";
								}
								for ($b = 0; $b < $nbrelupermodule[$a][1]; $b++){
									if ($tabrelu[$c] >= 1){
							?>
								<li class="list-group-item list-group-item-success"><?echo $listeitem[$c]." <b>(Relu ".$tabrelu[$c]." fois)</b>"; ?></li>
							<?
									}
									$c++;
								}
							?>
						</ul>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>
		<?
		}
		?>
		<div class="col">
			<!-- CARDS UE PROGRESSIONS -->
			<div class="row ml-4 mt-4 mb-4">
				<?
				for ($a= 0; $a < 11; $a++){
					?>
				<div class="card shadow-sm position-relative mt-4 mb-4 mr-5" style="width: 20rem;">
					<div class="test shadow-sm rounded-circle d-flex justify-content-center align-items-center position-absolute" style="background-color: <?echo $couleurs[$a];?>;">
					<span class="text-white material-icons" style="font-size: 3rem;">emoji_events</span>
					</div>
					<div class="card-body bg-light">
						<h5 class="card-text d-flex justify-content-center align-items-center">Module <?echo ($a+1);?></h5>
						<div class="progress mt-3">
							<? if($nbrelupermodule[$a][0] < $nbrelupermodule[$a][1]/2) $color = "bg-warning"; else $color = "bg-success"; ?>
							<div id="pUE1" class="progress-bar text-center text-dark <? echo $color; ?>" role="progressbar" style="width: <? echo (($nbrelupermodule[$a][0]/$nbrelupermodule[$a][1])*100); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><? echo ($nbrelupermodule[$a][0])." items relus sur ".$nbrelupermodule[$a][1]; ?></div>
						</div>
					</div>
					<div class="card-footer text-center" style="color: <?echo $couleurs[$a]; ?>; background-color: <?echo $txtcouleurs[$a]; ?>;" >
						<a class="h6 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#module<?echo $a;?>"><?echo $titremodule[$a];?></a>
					</div>
				</div>
					<?
				}

				?>
			</div>
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
		<?}?>
		<?if ($essai){?>
			<!-- PAYPAL -->
			<script  src="https://www.paypal.com/sdk/js?client-id=AXvKMfvS4lAIuop8bSUYw7CF4KudlwvRuO_-av5RyD_pLpAimO4xnjy_lVlmvxuanMvHaLYMfZQV3uPv&currency=EUR"></script>
			<!-- -->
			<div class="col mb-4 mt-4">
				<ul class="list-group">
					<li class="list-group-item bg-dark text-white h5">Mettez à niveau votre compte, prix unique : 5,00€</li>
					<li class="list-group-item d-flex align-items-center justify-content-center"><span id="btnpaypal"></span></li>
				</ul>
			</div>
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
	</body>
</html>