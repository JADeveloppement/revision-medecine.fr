<?
	if (!isset($_COOKIE['ECN-SUIVI-nom']) || !isset($_COOKIE['ECN-SUIVI-var']))
		header("Location: /ecn/");
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
		$txtlimititem = [" 1 à 20)", " 21 à 52)", " 53 à 78)", " 79 à 114)", " 115 à 140)", " 141 à 179)", " 180 à 216)", " 217 à 285)", " 286 à 316)", " 317 à 325)", " 326 à 362)"];
		$titremodule = ["Apprentissage de l'exercice médical", "De la conception à la naissance", "Maturation et vulnérabilité", "Perception, système nerveux, revêtement cutané", "Handicap, vieillissement, dépendance, douleurs", "Maladies transmissibles, risque sanitaire, santé au travail", "Inflammation, immunopathologie, poumon, sang", "Circulation, métabolisme", "Onco hématologie", "Le bon usage du médicament et thérapeutique non médicamenteuse", "Urgence et défaillance viscérales aiguës"];
		$couleurs = ["#007bff","#6610f2","#6f42c1","#e83e8c","#dc3545","#fd7e14","#ffc107","#28a745","#20c997","#17a2b8","#17a2b8"];
		$txtcouleurs = ["#B4D7FD","#B193FB","#B39DDD","#F4A9CB","#ED9CA4","#FEBF8A","#FDE18B","#A2E7B2","#93F0D5","#92E9F7","#BDF1FA"];
		$c = 0;
		for ($a = 0; $a < 11; $a++){
			for ($b = 0; $b < $nbrelupermodule[$a][1]; $b++){
				$d = explode("777ecn", $donneeslecture[$c]);
				if (intval(trim($d[1])) >= 1)
					$nbrelupermodule[$a][0]++;
				$c++;
			}
		}

		$listeitem = explode("2019ecn", trim(fgets(fopen("listeitem", "r"))));
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

		<?include_once "header.php";?>

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
		<? if ($essai && $expired){ ?>
		<div class="col mt-4 mb-4">
			<ul class="list-group">
				<li class="list-group-item bg-dark text-white h5">Informations</li>
				<li class="list-group-item list-group-item-warning">Votre période d'essai est terminé. Veuillez le mettre à niveau pour accéder à toutes les fontionnalités du site.</li>
			</ul>
		</div>
		<div class="col">
			<ul class="list-group">
				<li class="list-group-item bg-dark text-white h5">
					<div class="col">Liste des modules</div>
				</li>
				<?
				$c = 1;
				for ($a= 0; $a < 11; $a++){
					?>
				<li class="list-group-item text-muted">
					<div class="col">
						<div class="row">
							<div class="col"><?echo "Module ".($a+1)." : ".$titremodule[$a]."<span class='small'> (item de ".$txtlimititem[$a]."</span>"; ?></div>
							<div class="col-md-auto"><button class="btn btn-secondary material-icons" disabled>remove_red_eye</button></div>
						</div>
					</div>
				</li>
					<?
				}

				?>
			</ul>
		</div>
			<? }


		else if ($essai && !$expired || !$essai){
		?>
		<div class="col mt-4" id="waiting">
			<div class="col-md-auto d-flex align-items-center justify-content-center mb-4">
				<span class="spinner-border text-muted" style="width: 5rem; height: 5rem;"></span>
			</div>
			<div class="col-md-auto d-flex align-items-center justify-content-center">
				<span class="h2 text-muted">Chargement...</span>
			</div>
		</div>

		<div class="col mt-4 sr-only" id="page">
			<ul class="list-group mb-4">
				<li class="list-group-item bg-dark text-white h5">
					<div class="row">
						<div class="col">Rechercher un item</div>
						<div class="col-md-auto"><input type="text" id="searchitem" class="form-control" placeholder="Votre recherche"></div>
					</div>
				</li>
				<li class="list-group-item list-group-item-warning">Remarque : Si vous cherchez un item entre 1 et 99, rajoutez un "." et un espace (ex: "1. " ou "15. ") dans le champs pour effectuer correctement votre recherche.</li>
				<li class="list-group-item d-flex align-items-center sr-only" id="rechercher"><span class="spinner-grow"></span> Recherche...</li>
				<?
				$f = fopen("listeitem", "r");
				$g = explode("2019ecn", trim(fgets($f)));
				fclose($f);
				$indice = 0;
				foreach($g as $i){
					if (strlen($i) >= 4){
						echo "<li class='list-group-item sr-only' abs='$indice'>";
							echo "<div class='row'>";
								echo "<div class='col-md-auto'><button class='btn btn-outline-danger' abs='Sbtnrelu' indice='$indice' id='Sbtnrelu$indice'><span class='material-icons'>post_add</span><spanc class='badge badge-secondary' id='searchspanrelu$indice'>0</span></button></div>";
								echo "<div class='col-lg-2'>"; 
									echo "<div class='input-group'>";
										echo "<div class='input-group-prepend'>";
											echo "<button class='btn btn-primary material-icons' abs='Sbtnedit' id='Sbtnedit$indice' indice='$indice'>update</button>";
										echo "</div>";
										echo "<input type='number' abs='Sinputedit$indice' class='form-control'>";
									echo "</div>";
								echo "</div>";
								echo "<div class='col-md-auto'><button class='btn btn-outline-danger' abs='Sbtnfiche' id='searchfiche$indice' indice='$indice'>Fiché : Non</button></div>";
								echo "<div class='col' abs='item'>$i</div>";
								echo "<div class='col-md-auto'><span class='badge badge-success' id='searchsaved$indice'>Enregistré !</span></div>";
							echo "</div>";
						echo "</li>";
						$indice++;
					}
				}
				?>
			</ul>
			<ul class="list-group">
				<li class="list-group-item list-group-item-dark h5">
					<div class="row">
						<div class="col">Liste des modules</div>
					</div>
				</li>
				<?
				$c = 1;
				for ($a= 0; $a < 11; $a++){
					?>
				<li class="list-group-item">
					<div class="col">
						<div class="row">
							<div class="col"><?echo "Module ".($a+1)." : ".$titremodule[$a]."<span class='small'> (item de ".$txtlimititem[$a]."</span>"; ?></div>
							<div class="col-md-auto"><button class="btn btn-light material-icons" data-toggle="collapse" data-target="#module<?echo ($a+1);?>">remove_red_eye</button></div>
						</div>
						<div class="col">
							<ul class="list-group collapse mt-2" id="module<?echo ($a+1);?>">
								<?
									for ($b = 0; $b < $nbrelupermodule[$a][1]; $b++){
										?>
										<li class='list-group-item list-group-item-light' abs='search' item='<?echo ($c-1);?>'>
											<div class="row" abs='search'>
												<div class="col-md-auto">
													<button class="btn btn-outline-danger" name='relu' id='r<?echo ($c-1);?>' abs='<?echo ($c-1);?>'>
														<span class="material-icons">post_add</span>
														<span class="badge badge-secondary" name='relecture' id="s<?echo ($c-1);?>" abs='<?echo ($c-1);?>'><? echo (explode("777ecn", $donneeslecture[($c-1)]))[1];?></span>
													</button>
												</div>
												<div class="col-lg-2">
													<div class="input-group">
														<div class="input-group-prepend">
															<button class="btn btn-primary material-icons" name='editer' abs='<?echo ($c-1);?>' id='e<?echo ($c-1);?>'>update</button>
														</div>
														<input type="number" name="e<?echo ($c-1);?>" value="0" class="form-control">
													</div>
												</div>
												<?
												if ((explode("777ecn", $donneeslecture[($c-1)]))[0] == 0)
												{
													$txt = "Non"; 
													$fichecolor = "btn-outline-danger";
												}
												else if ((explode("777ecn", $donneeslecture[($c-1)]))[0] == 1){ 
													$txt = "Oui"; 
													$fichecolor = "btn-outline-success"; 
												}
												?>
												<div class="col-md-auto"><button class="btn <?echo $fichecolor; ?>" name='fiche' abs='<?echo ($c-1);?>' id="f<?echo ($c-1);?>">Fiché : <?echo $txt; ?></button></div>
												<div class="col"><span class="mr-2" name="spinner<?echo ($c-1);?>"></span><?echo $listeitem[$c]; ?></div>
												<div class="col-md-auto"><span class="badge badge-success" id="b<?echo ($c-1);?>">Enregistré !</span></div>
											</li>
										<?
										$c++;
									}

								?>
							</ul>
						</div>
					</div>
				</li>
					<?
				}

				?>
			</ul>
		</div>

		<script>
			window.onload = function(){
				$("#page").removeClass('sr-only');
				$("#waiting").addClass('sr-only').html('');
			};
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

		<script src="functions.js"></script>
	</body>
</html>