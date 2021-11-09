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
			$offre[0] = "Période d'essai";
			$fin = $line3+$jouressai*24*3600;
			if (time() >= $fin)
				$expired = true;
		}


		$titrecard = ["Progression UE1", "Progression UE2", "Progression UE3A", "Progression UE4"];
		$titremodule = ["UE1 - Chimie générale, organique, bioénergétique", "UE2 - Histologie, Biologie cellulaire, embryologie", "UE3A - Physique appliquée à la médecine", "UE4 - Mathématiques appliquées à la médecine"];
		$couleurs = ["#007bff","#6610f2","#6f42c1","#e83e8c"];
		$txtcouleurs = ["#B4D7FD","#B193FB","#B39DDD","#F4A9CB"];

		$nbrelupermodule = [[0, 53], [0, 55], [0, 28], [0, 20]];

		$f = fopen("../bddusers/".$_COOKIE['PACES-DEMOCRITE'], "r");
		$a = fgets($f); $donneeslectures = explode("2019paces", trim(fgets($f)));
		fclose($f);
		
		$a = 0;
		$totalrelu = 0;
		for($b = 0; $b < 4; $b++){
			for ($c = 0; $c < $nbrelupermodule[$b][1]; $c++){
				if (intval($donneeslectures[$a]) >= 1){
					$totalrelu++;
					$nbrelupermodule[$b][0]++;
				}
				$a++;
			}
		}

		$listecours = explode("2019paces", fgets(fopen("listecours/listecoursS1", "r")));
	}
?>
<html>
	<head>
		<title>D-Learning - Suivi cours</title>
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

			.test {
				width: 75px;
				height: 75px;
				top: -1.5rem;
				left: -1.5rem;
			}

		</style>

		<?include_once "header.php";?>

		<?include_once "abonnementsuivicours.php";?>

		<!-- VUE BUREAU -->
		<div class="container-fluid mt-4 mb-4" id="desktop">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white font-weight-bold h3 d-flex justify-content-center">Votre suivi de cours</li>
					<li class="list-group-item">
						<div class="progress mt-3">
							<div class="progress-bar text-center text-dark bg-primary" role="progressbar" style="width: <? echo ($totalrelu/156*100); ?>%" id="progressG" aria-valuemin="0" aria-valuemax="100"><? echo $totalrelu." cours relus sur 156"; ?></div>
						</div>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<div class="row">
				<?
				for ($a = 0; $a <  4; $a++){
					?>
					<div class="col d-flex align-items-center justify-content-center">
						<div class="card shadow-sm position-relative mt-4 mb-4 mr-5" style="width: 20rem;">
							<div class="test shadow-sm rounded-circle d-flex justify-content-center align-items-center position-absolute" style="background-color: <?echo $couleurs[$a];?>;">
							<span class="text-white material-icons" style="font-size: 3rem;">emoji_events</span>
							</div>
							<div class="card-body bg-light">
								<h5 class="card-text d-flex justify-content-center align-items-center"><?echo $titrecard[$a]; ?></h5>
								<div class="progress mt-3">
									<? if($nbrelupermodule[$a][0] < $nbrelupermodule[$a][1]/2) $color = "bg-warning"; else $color = "bg-success"; ?>
									<div id="progression<?echo $a;?>" class="progress-bar text-center text-dark <? echo $color; ?>" role="progressbar" style="width: <? echo (($nbrelupermodule[$a][0]/$nbrelupermodule[$a][1])*100); ?>%" aria-valuemin="0" aria-valuemax="100"><? echo ($nbrelupermodule[$a][0])." cours relus sur ".$nbrelupermodule[$a][1]; ?></div>
								</div>
							</div>
							<div class="card-footer text-center" style="color: <?echo $couleurs[$a]; ?>; background-color: <?echo $txtcouleurs[$a]; ?>;" >
								<a class="h6 d-flex justify-content-center align-items-center font-weight-bold"><?echo $titremodule[$a];?></a>
							</div>
						</div>
					</div>
					<?
				}
				?>
				</div>
			</div>

			<? if (!$expired){ ?>
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5">Liste des heures de cours</li>
					<?
					$a = 0;
					for($b = 0; $b < 4; $b++){
						?>
						<li class="list-group-item"><?echo $titremodule[$b]?><span class="float-right"><button class="btn btn-light material-icons" data-toggle="collapse" data-target="#UE<?echo $b;?>">remove_red_eye</button></span></li>
						<?
						for($c = 0; $c < $nbrelupermodule[$b][1]; $c++){
							?>
							<li class="list-group-item collapse" id="UE<?echo $b;?>">
								<div class="row">
									<div class="col-md-auto">
										<button class="btn btn-outline-danger" name="relu" id="br<?echo $a;?>" abs="<?echo $a;?>">
											<span class='material-icons'>post_add</span>
											<span class="badge badge-secondary" id='nr<?echo $a;?>'><?echo $donneeslectures[$a];?></span>
										</button>
									</div>
									<div class="col-lg-2">
										<div class="input-group">
											<div class='input-group-prepend'>
												<button class="btn btn-primary material-icons" name='edit' id="be<?echo $a;?>" abs="<?echo $a;?>" >settings_backup_restore</button>
											</div>
											<input class="form-control" type="number" min="0" value="<?echo $donneeslectures[$a];?>" name='nvnb' id='nv<?echo $a;?>'>
										</div>
									</div>
									<div class="col"><?echo $listecours[$a];?></div>
								</div>
							</li>
							<?
							$a++;
						}
					}
					?>
				</ul>
			</div>
			<?} else {?>
			<div class="col mb-4">
				<ul class="list-group mt-4 mb-4">
					<li class="list-group-item bg-dark text-white h5">Informations</li>
					<li class="list-group-item list-group-item-warning">Votre offre a expiré. Veuiller le mettre à niveau pour utiliser cette fonctionnalité.</li>
					<li class="list-group-item">
						<div class="row centre">
							<div class="col-md-auto">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiements1">Semestre 1 (7€)</button>
							</div>
							<div class="col-md-auto">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiements2">Semestre 2 (10€)</button>
							</div>
							<div class="col-md-auto">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementannuel">Annuel (15€)</button>
							</div>
						</div>
					</li>
				</ul>
			<?}?>
		</div>
		<!-- VUE BUREAU -->

		<!-- VUE MOBILE -->
		<div id="mobile">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white font-weight-bold h3 d-flex justify-content-center">Votre suivi de cours</li>
					<li class="list-group-item">
						<div class="progress mt-3">
							<div class="progress-bar text-center text-dark bg-primary" role="progressbar" style="width: <? echo ($totalrelu/156*100); ?>%" id="progressG" aria-valuemin="0" aria-valuemax="100"><? echo $totalrelu." cours relus sur 156"; ?></div>
						</div>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<div class="row centre">
				<?
				for ($a = 0; $a <  4; $a++){
					?>
					<div class="col centre">
						<div class="card shadow-sm position-relative mt-4 mb-4 mr-5" style="width: 20rem;">
							<div class="test shadow-sm rounded-circle d-flex justify-content-center align-items-center position-absolute" style="background-color: <?echo $couleurs[$a];?>;">
							<span class="text-white material-icons" style="font-size: 3rem;">emoji_events</span>
							</div>
							<div class="card-body bg-light">
								<h5 class="card-text d-flex justify-content-center align-items-center"><?echo $titrecard[$a]; ?></h5>
								<div class="progress mt-3">
									<? if($nbrelupermodule[$a][0] < $nbrelupermodule[$a][1]/2) $color = "bg-warning"; else $color = "bg-success"; ?>
									<div id="progression<?echo $a;?>" class="progress-bar text-center text-dark <? echo $color; ?>" role="progressbar" style="width: <? echo (($nbrelupermodule[$a][0]/$nbrelupermodule[$a][1])*100); ?>%" aria-valuemin="0" aria-valuemax="100"><? echo ($nbrelupermodule[$a][0])." cours relus sur ".$nbrelupermodule[$a][1]; ?></div>
								</div>
							</div>
							<div class="card-footer text-center" style="color: <?echo $couleurs[$a]; ?>; background-color: <?echo $txtcouleurs[$a]; ?>;" >
								<a class="h6 d-flex justify-content-center align-items-center font-weight-bold"><?echo $titremodule[$a];?></a>
							</div>
						</div>
					</div>
					<?
				}
				?>
				</div>

				<? if (!$expired){ ?>
				<div class="col mb-4">
					<ul class="list-group">
						<li class="list-group-item list-group-item-primary h5">Liste des heures de cours</li>
						<?
						$a = 0;
						for($b = 0; $b < 4; $b++){
							?>
							<li class="list-group-item d-flex align-items-center"><?echo $titremodule[$b]?><span class="float-right"><button class="btn btn-light material-icons" data-toggle="collapse" data-target="#UE<?echo $b;?>">remove_red_eye</button></span></li>
							<?
							for($c = 0; $c < $nbrelupermodule[$b][1]; $c++){
								?>
								<li class="list-group-item collapse" id="UE<?echo $b;?>">
									<div class="col">
										<div class="col mb-2"><?echo $listecours[$a];?></div>
										<div class="col">
											<div class="row">
												<div class="col-md-auto mb-2">
													<button class="btn btn-outline-danger" name="relu" id="br<?echo $a;?>" abs="<?echo $a;?>">
														<span class='material-icons'>post_add</span>
														<span class="badge badge-secondary" id='nr<?echo $a;?>'><?echo $donneeslectures[$a];?></span>
													</button>
												</div>
												<div class="col mb-2">
													<div class="input-group" style="width: 200px;">
														<div class='input-group-prepend'>
															<button class="btn btn-primary material-icons" name='edit' id="be<?echo $a;?>" abs="<?echo $a;?>" >settings_backup_restore</button>
														</div>
														<input class="form-control" type="number" min="0" value="<?echo $donneeslectures[$a];?>" name='nvnb' id='nv<?echo $a;?>'>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?
								$a++;
							}
						}
						?>
					</ul>
				</div>
				<?} else {?>
				<div class="col mb-4">
					<ul class="list-group mt-4 mb-4">
						<li class="list-group-item bg-dark text-white h5">Informations</li>
						<li class="list-group-item list-group-item-warning">Votre offre a expiré. Veuiller le mettre à niveau pour utiliser cette fonctionnalité.</li>
						<li class="list-group-item">
							<div class="row centre">
								<div class="col-md-auto">
									<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiements1">Semestre 1 (7€)</button>
								</div>
								<div class="col-md-auto">
									<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiements2">Semestre 2 (10€)</button>
								</div>
								<div class="col-md-auto">
									<button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementannuel">Annuel (15€)</button>
								</div>
							</div>
						</li>
					</ul>
				<?}?>

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

			nbue = [<? echo $nbrelupermodule[0][0]; ?>, <? echo $nbrelupermodule[1][0]; ?>, <? echo $nbrelupermodule[2][0]; ?>,<? echo $nbrelupermodule[3][0]; ?>];

			function changed(a, b){
				if (a >= 0 && a < 53){
					if (parseInt($("#nr"+a).html()) == 0){
						if (b > 0)
							nbue[0]++;
					}else if (b == 0 && nbue[0] > 0) nbue[0]--;
					$("#progression0").attr("style", "width: "+((nbue[0]/53)*100)+"%").html(nbue[0]+" cours relus sur 53");
				} 
				else if (a < 108){
					if (parseInt($("#nr"+a).html()) == 0){
						if (b > 0)
							nbue[1]++;
							
					}else if (b == 0 && nbue[1] > 0) nbue[1]--;
					$("#progression1").attr("style", "width: "+((nbue[1]/55)*100)+"%").html(nbue[1]+" cours relus sur 55");
				} 
				else if (a < 136){
					if (parseInt($("#nr"+a).html()) == 0){
						if (b > 0)
							nbue[2]++;
							
					}else if (b == 0 && nbue[2] > 0) nbue[2]--;
					$("#progression2").attr("style", "width: "+((nbue[2]/28)*100)+"%").html(nbue[2]+" cours relus sur 28");
				} 
				else if (a < 156){
					if (parseInt($("#nr"+a).html()) == 0){
						if (b > 0)
							nbue[3]++;
							
					}else if (b == 0 && nbue[3] > 0) nbue[3]--;
					$("#progression3").attr("style", "width: "+((nbue[3]/20)*100)+"%").html(nbue[3]+" cours relus sur 20");
				}


				$("#br"+a).attr("disabled", false);
				$("#be"+a).attr("disabled", false);
				$("#s"+a).removeClass("spinner-grow");
				$("#b"+a).fadeIn().fadeOut();
				$("#nr"+a).html(b);
				if (parseInt(b) > 3){
					$("#br"+a).removeClass("btn-outline-danger").removeClass("btn-outline-warning").addClass('btn-outline-success');
				}
				else if (parseInt(b) > 0)
				{
					$("#br"+a).removeClass("btn-outline-danger").removeClass('btn-outline-success').addClass("btn-outline-warning");
				}
				else {
					$("#br"+a).removeClass("btn-outline-warning").removeClass('btn-outline-success').addClass("btn-outline-danger");	
				}

				total = 0;
				for (a = 0; a < 4; a++){
						total+= nbue[a];
				}
				$("#progressG").html(total+" cours relus sur 156.");
				$("#progressG").attr("style", "width: "+(total/156)*100+"%");
			}

			$("button[name='relu']").click(function(){
				var nb = $(this).attr("abs");
				$.post(
					'functions.php',
					{action: 1, item: nb},
					function(data){
						//alert(data);
						changed(nb, data);
					}
				);
			})

			$("button[name='edit']").click(function(){
				var nb = $(this).attr("abs");
				var nvnb = $("#nv"+$(this).attr("abs")).val();
				$.post(
					'functions.php',
					{action: 2, item: nb, nvnb: nvnb},
					function(data){
						changed(nb, data);
					}
				);
			})
		</script>

		<?include_once "footer.php";?>
	</body>
</html>