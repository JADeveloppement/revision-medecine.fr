<?
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");
	else {
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$identite = explode("2019paces", trim(fgets(fopen("../bddusers/$username", "r"))));
		$listecoursdispo = array();
		$f = fopen("listecoursfiche", "r");
		while(($line = fgets($f)) !== false)
			array_push($listecoursdispo, trim($line));
		fclose($f);

		$listecoursperso = explode("---", trim(fgets(fopen("../bddusers/cours/".$_COOKIE['PACES-DEMOCRITE'], "r"))));

		$module = ["UE1 - Chimie générale, organique, biologie moléculaire", "UE2 - Embryologie, Histologie, biologie cellulaire", "UE3A - Physique appliquée à la médecine", "UE4 - Mathématiques appliquées à la médecine"];
		$coursperue = [array(), array(), array(), array(), 0, array(), array(), array(), array()];

		$f = fopen("listecoursfiche", "r");

		$nbS1 = 0; $nbS2 = 0;
		while(($line = fgets($f)) !== false){
			$a = explode("2019paces", trim($line));
			if (strpos($a[4], "UE1") !== false)
				array_push($coursperue[0], trim($line));
			if (strpos($a[4], "UE2") !== false)
				array_push($coursperue[1], trim($line));
			if (strpos($a[4], "UE3A") !== false)
				array_push($coursperue[2], trim($line));
			if (strpos($a[4], "UE4") !== false)
				array_push($coursperue[3], trim($line));

			if (strpos($a[4], "UE3B") !== false)
				array_push($coursperue[5], trim($line));
			if (strpos($a[4], "UE5") !== false)
				array_push($coursperue[6], trim($line));
			if (strpos($a[4], "UE6") !== false)
				array_push($coursperue[7], trim($line));
			if (strpos($a[4], "UE7") !== false)
				array_push($coursperue[8], trim($line));

			if (strpos($a[4], "UE1") !== false || strpos($a[4], "UE2") !== false || strpos($a[4], "UE3A") !== false || strpos($a[4], "UE4") !== false)
				$nbS1++;
			else if (strpos($a[4], "UE3B") !== false || strpos($a[4], "UE5") !== false || strpos($a[4], "UE6") !== false || strpos($a[4], "UE7") !== false)
				$nbS2++;

		}
		fclose($f);

		$moduleS2 = ["UE3B - Physiologie", "UE5 - Anatomie", "UE6 - Pharmacologie", "UE7 - Sciences, humanité, société"];
		
		function makelist($b, $s1){
			global $identite;

			$indice = 0;
			foreach($b as $a){
				$titre = (explode("2019paces", $a))[0];
				$urltotal = (explode("2019paces", $a))[1];
				$urlapercu = (explode("2019paces", $a))[2];
				$prix = (explode("2019paces", $a))[3];

				echo "<li class='list-group-item'>";
					echo "<div class='col'>";
						echo "<div class='col centre mb-2'>$titre</div>";
						echo "<div class='col'>";
							echo "<span class='centre'>";
								if ($identite[13] == 3)
									echo "<button class='btn btn-secondary'>Acheté</button>";
								else if ($identite[13] == 1 && (strpos($titre, "UE1") !== false || strpos($titre, "UE2") !== false || strpos($titre, "UE3A") !== false || strpos($titre, "UE4") !== false))
									echo "<button class='btn btn-secondary'>Acheté</button>";
								else if ($identite[13] == 2 && (strpos($titre, "UE3B") !== false || strpos($titre, "UE5") !== false || strpos($titre, "UE6") !== false || strpos($titre, "UE7") !== false))
									echo "<button class='btn btn-secondary'>Acheté</button>";
								else if ($identite[13] == 0){
									if (strpos(implode("---", $listecoursperso), $urlapercu) !== false)
										echo "<button class='btn btn-secondary'>Acheté</button>";
									else {
										echo "<button class='btn btn-success' name='apercu' val='$urlapercu' titre='$titre'>Aperçu</button>";
										echo "<button class='btn btn-primary' name='acheter' titre='$titre' abs='$urlapercu'>$prix €</button>";
									}
								} else {
									echo "<button class='btn btn-success' name='apercu' val='$urlapercu' titre='$titre'>Aperçu</button>";
									echo "<button class='btn btn-primary' name='acheter' titre='$titre' abs='$urlapercu'>$prix €</button>";
								}
							echo "</span>";
						echo "</div>";
					echo "</div>";
				echo "</li>";
			}
		}
	}
?>
<html>
	<head>
		<title>D-Learning - Cours</title>
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

		<!--  PAYPAL  -->
		<script  src="https://www.paypal.com/sdk/js?client-id=AXvKMfvS4lAIuop8bSUYw7CF4KudlwvRuO_-av5RyD_pLpAimO4xnjy_lVlmvxuanMvHaLYMfZQV3uPv&currency=EUR"></script>
		<!-- <script  src="https://www.paypal.com/sdk/js?client-id=AQpk_wnJIkBChrUr9IjdNd0ukcq82VBaxaoup_fPXaYXHuO_LZTzrr8k6XbtXhEbmlDbfmQd3K_b7n-F&currency=EUR"></script>-->

		<div class="modal fade" id="modalachat" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">Achat d'un cours</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group mt-4 mb-4">
								<li class="list-group-item list-group-item-success h5" id="achatcourstitre"></li>
								<li class="list-group-item font-weight-bold" id="achatprix"></li>
								<li class="list-group-item centre" id="contenupanier"></li>
							</ul>
						</div>
						<script> 
							function makepanier(d, p){
								paypal.Buttons({
									createOrder: function(data, actions){
										return actions.order.create({
											purchase_units: [{
												amount: { value: d+'.00'}
											}]
										});
									}, 
									onApprove: function(data, actions) {
										return actions.order.capture().then(function(details) {
											$("#contenupanier").html("<span class='d-flex align-items-center justify-content-center'><span class='spinner-grow'></span>Chargement</span>");
											$.post(
												'functions.php',
												{action: 3, param: p},
												function(data){
													alert("Paiement effectué, merci pour votre achat. La page s'actualisera automatiquement.");
													window.location = 'cours';
												}
											);
										});
									}
								}).render('#btnpaypal')
							}
						</script>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE1" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE1 - Chimie générale, organique, bioénergétique</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[0], true); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE2" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE2 - Biologie cellulaire, histologie, embryologie</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[1], true); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE3A" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE3A - Physique appliquée à la médecine</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[2], true); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE4" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE4 - Mathématiques appliquées à la médecine</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[3], true); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE3B" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE3B - Mécanique des fluides, transports membranaire, équilibre acidobasique</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[5], false); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE5" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE5 - Anatomie</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group-item container-fluid mt-2">
								<? makelist($coursperue[6], false); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE6" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE6 - Pharmacologie</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group container-fluid mt-2">
								<?
								makelist($coursperue[7], false);
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade listecours" id="modalUE7" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title">UE7 - Sciences, humanité, société</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col centre">
							<ul class="list-group container-fluid mt-2">
								<?
								makelist($coursperue[8], false);
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid mt-4 mb-4">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white font-weight-bold h3 d-flex justify-content-center">Fiches et Cours</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 centre"><span class="material-icons mr-3">assessment</span>Votre abonnement :
						<?
						if (intval($identite[13]) == 0) echo "Aucun abonnement";
						if (intval($identite[13]) == 1) echo "Cours Semestre 1";
						if (intval($identite[13]) == 2) echo "Cours Semestre 2";
						if (intval($identite[13]) == 3) echo "Cours Annuel";
						?>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5 font-weight-bold">Cours et Fiches disponibles<span class="d-flex align-items-center float-right"><span class="badge badge-secondary"><? echo count($listecoursdispo); ?></span></span></li>
					<li class="list-group-item list-group-item-warning small">Pour une version papier des cours (envoyé par voie postale), veuillez nous contacter par mail (contact@revision-medecine.fr).</li>
					<li class="list-group-item alert-primary">Cours du Semestre 1<span class="float-right"><button class="btn btn-light material-icons" data-toggle="collapse" data-target="#semestre1">remove_red_eye</button></span></li>
					<li class="list-group-item collapse centre" id="semestre1"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE1">UE1 - Chimie générale, organique, bioénérgétique</button></li>
					<li class="list-group-item collapse centre" id="semestre1"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE2">UE2 - Biologie cellulaire, histologie, embryologie</button></li>
					<li class="list-group-item collapse centre" id="semestre1"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE3A">UE3A - Physique appliquée à la médecine</button></li>
					<li class="list-group-item collapse centre" id="semestre1"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE4">UE4 - Mathématiques appliquées à la médecine</button></li>
					<li class="list-group-item alert-primary">Cours du Semestre 2<span class="float-right"><button class="btn btn-light material-icons" data-toggle="collapse" data-target="#semestre2">remove_red_eye</button></span></li>
					<li class="list-group-item collapse centre" id="semestre2"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE3B">UE3B - Physique des fluides, équilibre acido-basique, transports membranaires</button></li>
					<li class="list-group-item collapse centre" id="semestre2"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE5">UE5 - Anatomie</button></li>
					<li class="list-group-item collapse centre" id="semestre2"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE6">UE6 - Pharmacologie</button></li>
					<li class="list-group-item collapse centre" id="semestre2"><button class="btn btn-primary" data-toggle="modal" data-target="#modalUE7">UE7 - Santé, société, humanité</button></li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5">Vos cours possédés <span class="float-right badge badge-secondary"><? if (intval($identite[13]) == 0) echo (count($listecoursperso)-1); else if (intval($identite[13]) == 1) echo $nbS1; else if (intval($identite[13]) == 2) echo $nbS2; else if (intval($identite[13]) == 3) echo ($nbS1+$nbS2); ?></span></li>
					<?
						if (intval($identite[13]) == 1){
							foreach($listecoursdispo as $i){
								$titre = (explode("2019paces", $i))[0];
								$urltotal = (explode("2019paces", $i))[1];
								$urlapercu = (explode("2019paces", $i))[2];
								$prix = (explode("2019paces", $i))[3];
								if (strpos($titre, "UE1") !== false || strpos($titre, "UE2") !== false || strpos($titre, "UE3A") !== false || strpos($titre, "UE4") !== false){
									echo "<li class='list-group-item'>";
										echo "<div class='row'>";
											echo "<div class='col'>$titre</div>";
											echo "<div class='col'><button class='btn btn-primary material-icons float-right' name='voir' titre='$titre' value='$urltotal'>remove_red_eye</button></div>";
										echo "</div>";
									echo "</li>";
								}
							}
						}
						else if (intval($identite[13]) == 2){
							foreach($listecoursdispo as $i){
								$titre = (explode("2019paces", $i))[0];
								$urltotal = (explode("2019paces", $i))[1];
								$urlapercu = (explode("2019paces", $i))[2];
								$prix = (explode("2019paces", $i))[3];
								if (strpos($titre, "UE3B") !== false || strpos($titre, "UE5") !== false || strpos($titre, "UE6") !== false || strpos($titre, "UE7") !== false){
									echo "<li class='list-group-item'>";
										echo "<div class='row'>";
											echo "<div class='col'>$titre</div>";
											echo "<div class='col'><button class='btn btn-primary material-icons float-right' name='voir' titre='$titre' value='$urltotal'>remove_red_eye</button></div>";
										echo "</div>";
									echo "</li>";
								}
							}
						}
						else if (intval($identite[13]) == 3){
							foreach($listecoursdispo as $i){
								$titre = (explode("2019paces", $i))[0];
								$urltotal = (explode("2019paces", $i))[1];
								$urlapercu = (explode("2019paces", $i))[2];
								$prix = (explode("2019paces", $i))[3];
								if (strlen($titre) > 5){
									echo "<li class='list-group-item'>";
										echo "<div class='row'>";
											echo "<div class='col'>$titre</div>";
											echo "<div class='col'><button class='btn btn-primary material-icons float-right' name='voir' titre='$titre' value='$urltotal'>remove_red_eye</button></div>";
										echo "</div>";
									echo "</li>";
								}
							}
						}
						else if (intval($identite[13]) == 0){
							if (count($listecoursperso) == 0)
								echo "<li class='list-group-item list-group-item-danger'>Aucun cours achetés.</li>";
							else {
								$donnees = implode("---", $listecoursperso);
								foreach($listecoursdispo as $i){
									$titre = (explode("2019paces", $i))[0];
									$urltotal = (explode("2019paces", $i))[1];
									$urlapercu = (explode("2019paces", $i))[2];
									$prix = (explode("2019paces", $i))[3];
									if (strlen($titre) > 5 && strpos($donnees, $urlapercu) !== false){
										echo "<li class='list-group-item'>";
											echo "<div class='row'>";
												echo "<div class='col'>$titre</div>";
												echo "<div class='col'><button class='btn btn-primary material-icons float-right' name='voir' titre='$titre' value='$urltotal'>remove_red_eye</button></div>";
											echo "</div>";
										echo "</li>";
									}
								}
							}
						}
					?>
				</ul>
			</div>
		</div>

		<script>
			$("button[name='apercu']").click(function(){
				window.open('makecours.php?value='+$(this).attr("val")+"&titre=Aperçu "+$(this).attr('titre'), "_blank");
			})

			$("button[name='voir']").click(function(){
				window.open('makecours.php?value='+$(this).attr("value")+"&titre="+$(this).attr('titre'), "_blank");
			})	

			$("button[name='acheter']").click(function(){
				$("#modalUE1").modal('hide'); $("#modalUE2").modal('hide'); $("#modalUE3A").modal('hide'); $("#modalUE4").modal('hide'); $("#modalUE3B").modal('hide'); $("#modalUE5").modal('hide'); $("#modalUE6").modal('hide'); $("#modalUE7").modal('hide');
				titre = $(this).attr('titre');
				param = $(this).attr('abs');
				$("#modalachat").modal('show');
				$("#achatcourstitre").html(titre);
				$("#contenupanier").html("<span id='btnpaypal'></span>");
				$.post(
					'coursdispo/'+param, 
					{action: 2},
					function(data){
						$("#achatprix").html("Total : "+data+"€");
						makepanier(data, param);
					}, 
					'text'
				);
			});

			$("#modalachat").on("hide.bs.modal", function(e){
				$("#achatcourstitre").html("Sélectionnez un cours à visualiser.");
				$("#contenupanier").empty();
				$("#achatprix").html("Sélectionnez un article.");
			})
		</script>

		<script>
			/*if (/Mobi|Android/i.test(navigator.userAgent)) {
			    //alert("La navigation sur téléphone portable n'est pas optimisée. Consultez notre site internet sur un ordinateur pour une meilleure expérience d'utilisation.");
			    $("#desktop").empty();
			}
			else {
				$("#mobile").empty();
			}*/
		</script>

		<?include_once "footer.php";?>
	</body>
</html>