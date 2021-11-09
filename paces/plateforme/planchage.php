<?

	$username = $_COOKIE['PACES-DEMOCRITE'];

	$listeplanchage = scandir("planchagedispo/");

	$categorie = [array(), array(), array(), array()];

	$categorieS2 = [array(), array(), array()];

	$identite = explode("2019paces", fgets(fopen("../bddusers/$username", "r")));
	
	$planchagefait = array();
	$nbplanchagefait = 0;
	if (file_exists("participation/".$username)){
		$f = fopen("participation/".$username, "r");
		while (($line = fgets($f)) !== false){
			$nbplanchagefait++;
			array_push($planchagefait, explode("2019paces", trim($line))[0]);
		}
	}

	if ($identite[12] == 0){
		$offre = true;
	}

	function fait($a, $b){
		$res = false;
		$i = 0;
		while (!$res && $i < count($b)){
			if (strpos($b[$i], $a) !== false)
				$res = true;
			$i++;
		}

		return $res;
	}

	$texte = ["UE1 - Planchage Chimie Générale, organique, Bioénergétique, biomoléculaire", "UE2 - Planchage Biologie Cellulaire, histologie, embryologie", "UE3A - Planchage Physique appliquée à la médecine", "UE4MS - Planchage Mathématiques appliquées à la médecine"];

	$texteS2 = ["UE3B - Mécanique des fluides, équilibre acidobasique, transports membranaires, radioactivité", "UE5 - Anatomie", "UE6 - Pharmacologie"];

	foreach($listeplanchage as $i){
		if (strpos($i, "CG") !== false || strpos($i, "CO") !== false || strpos($i, "BG") !== false){
			array_push($categorie[0], $i);
		}
		else if (strpos($i, "BC") !== false || strpos($i, "EH") !== false || strpos($i, "HI") !== false){
			array_push($categorie[1], $i);
		}
		else if (strpos($i, "3A") !== false){
			array_push($categorie[2], $i);
		}
		else if (strpos($i, "4MS") !== false){
			array_push($categorie[3], $i);
		}

		else if (strpos($i, "3B") !== false){
			array_push($categorieS2[0], $i);
		}
		else if (strpos($i, "5AN") !== false){
			array_push($categorieS2[1], $i);
		}
		else if (strpos($i, "6PH") !== false){
			array_push($categorieS2[2], $i);
		}
	}
?>
<html>
	<head>
		<title>D-Learning - Planchage</title>
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
		<?include_once "abonnementsuivicours.php"; ?>

		<!-- VUE BUREAU -->
		<div class="container-fluid mt-4 mb-4" id="desktop">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white font-weight-bold h3 d-flex justify-content-center">Planchages</li>
					<li class="list-group-item">
						<div class="progress">
							<div class="progress-bar text-dark" role="progressbar" style="width: <?echo ($nbplanchagefait/(count($listeplanchage) - 4))*100;?>%;" aria-valuemin="0" aria-valuemax="100"><? echo $nbplanchagefait." faits sur ".(count($listeplanchage)-4) ?></div>
						</div>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-primary h5">Liste des plachages disponibles<span class="badge badge-secondary float-right"><? echo (count($listeplanchage)-4);  ?></span></li>
					<?
					$a = 0;
					$indice = 0;
					if (($identite[12] == 2 || $identite[12] == 5) && time() < strtotime("25-01-2020")){
						echo "<li class='list-group-item'>Vous êtes abonné(e) au Semestre 2, les planchages seront disponibles à partir du 25 Janvier 2020.</li>";
					}
					else {
						foreach($categorie as $k){
							echo "<li class='list-group-item alert-primary'>".$texte[$a]."<span class='ml-3 badge badge-secondary'>".count($k)."</span> <button class='btn btn-light float-right material-icons' data-toggle='collapse' data-target='#planchage$a'>remove_red_eye</button></li>";
							if (count($k) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$a'>Aucun planchage pour cette catégorie</li>";
							} else {
								$b = 1;
								foreach($k as $i){
									$res = fait($i, $planchagefait);
									$text = "<span class='badge badge-danger mr-3'>Non fait";
									$titreplanchage =  trim(fgets(fopen("planchagedispo/$i", "r")));
									if ($identite[12] == 0){
										if (strpos($i, "free") !== false){
											if ($res)
												$text = "<span class='badge badge-success mr-3'>Fait";
											echo "<li class='list-group-item collapse' id='planchage$a'>$titreplanchage<span class='badge badge-success ml-4'>Gratuit !</span><span class='float-right centre'>$text</span><button class='btn btn-primary mr-3' name='start' url='$i'>Commencer</button>";
											if ($res) echo "<button class='btn btn-success' name='corrige' url='$i'>Corrigé</button>";
												echo "</span></li>";
										}
										else {
											echo "<li class='list-group-item collapse' id='planchage$a'>$titreplanchage <span class='float-right'><button class='btn btn-secondary' disabled>Non abonné.</button></span></li>";
										}
									}
									else if ($identite[12] == 1 || $identite[12] == 3 || $identite[12] == 4 || $identite[12] == 5){
										if ($res)
											$text = "<span class='badge badge-success mr-3'>Fait";
										echo "<li class='list-group-item collapse' id='planchage$a'>$titreplanchage<span class='float-right centre'>$text</span><button class='btn btn-primary mr-3' name='start' url='$i'>Commencer</button>";
										if ($res) echo "<button class='btn btn-success' name='corrige' url='$i'>Corrigé</button>";
											echo "</span></li>";
									}
									$b++;
								}
							}
							$a++;
						}
					}
					?>
				</ul>

				<?if ($identite[12] == 0 || (($identite[12] == 2 || $identite[12] == 5) && time() < strtotime("25-01-2020"))) {?>
					<ul class="list-group mt-4">
						<li class='list-group-item bg-dark text-white h5'>Abonnement</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementoffre">Offre révisions (60€)</button></div>
								<?if ($identite[12] != 2 && $identite[12] != 5 && $identite[12] != 8){?>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2C">Abonnement Semestre 2 (avec concours) (250€)</button></div>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2SC">Abonnement Semestre 2 (sans concours) (180€)</button></div>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2UC">Abonnement Semestre 2 (uniquement concours) (70€)</button></div>
								<?}?>
							</div>
						</li>
					</ul>
				<?}?>
			</div>
		</div>
		<!-- VUE BUREAU -->

		<!-- VUE MOBILE -->
		<div id="mobile">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-white font-weight-bold h3 d-flex justify-content-center">Planchages</li>
					<li class="list-group-item">
						<div class="progress">
							<div class="progress-bar text-dark" role="progressbar" style="width: <?echo ($nbplanchagefait/(count($listeplanchage) - 4))*100;?>%;" aria-valuemin="0" aria-valuemax="100"><? echo $nbplanchagefait." faits sur ".(count($listeplanchage)-4) ?></div>
						</div>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-4">
					<li class="list-group-item list-group-item-primary h5">Liste des plachages disponibles<span class="badge badge-secondary float-right"><? echo (count($listeplanchage)-4);  ?></span></li>
					<?
					$a = 0;
					$indice = 0;
					if (($identite[12] == 2 || $identite[12] == 5) && time() < strtotime("25-01-2020")){
						echo "<li class='list-group-item'>Vous êtes abonné(e) au Semestre 2, les planchages seront disponibles à partir du 25 Janvier 2020.</li>";
					}
					else {
						foreach($categorie as $k){
							echo "<li class='list-group-item alert-primary centre'>".$texte[$a]."<span class='ml-3 badge badge-secondary mr-2'>".count($k)."</span> <button class='btn btn-light float-right material-icons' data-toggle='collapse' data-target='#planchage$a'>remove_red_eye</button></li>";
							if (count($k) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$a'>Aucun planchage pour cette catégorie</li>";
							} else {
								$b = 1;
								foreach($k as $i){
									$res = fait($i, $planchagefait);
									$text = "<span class='badge badge-danger mr-3'>Non fait";
									$titreplanchage =  trim(fgets(fopen("planchagedispo/$i", "r")));

									echo "<li class='list-group-item collapse' id='planchage$a'>";
										echo "<div class='col'>";
											echo "<div class='col'><b>$titreplanchage</b></div>";
											echo "<div class='col'>";
												if ($identite[12] == 0){
													if (strpos($i, "free") !== false){
														echo "<button class='btn btn-success btn-sm mr-3'>Gratuit !</button>";

														if (!$res)
															echo "<button class='btn btn-danger btn-sm mr-3'>Non fait</button>";

														echo "<button class='btn btn-primary mr-3' name='start' url='$i'>Commencer</button>";
														if ($res)
															echo "<button class='btn btn-warning' name='corrige' url='$i'>Corrigé</button>";
													}
													else echo "<button class='btn btn-secondary'>Non abonné</button>";
												}
												else if ($identite[12] == 1 || $identite[12] == 3 || $identite[12] == 4 || $identite[12] == 5){
													echo "<button class='btn btn-primary' name='start' url='$i'>Commencer</button>";
													if ($res)
														echo "<button class='btn btn-warning' name='corrige' url='$i'>Corrigé</button>";
												}
											echo "</div>";
										echo "</div>";
									echo "</li>";
									$b++;
								}
							}
							$a++;
						}
					}
					?>
				</ul>

				<?if ($identite[12] == 0) {?>
					<ul class="list-group mt-4">
						<li class='list-group-item bg-dark text-white h5'>Abonnement</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementoffre">Offre révisions (60€)</button></div>
								<?if ($identite[12] != 2 && $identite[12] != 5 && $identite[12] != 8){?>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2C">Abonnement Semestre 2 (avec concours) (250€)</button></div>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2SC">Abonnement Semestre 2 (sans concours) (180€)</button></div>
								<div class="col"><button class="btn btn-primary" data-toggle="modal" data-target="#modalpaiementplanchages2UC">Abonnement Semestre 2 (uniquement concours) (70€)</button></div>
								<?}?>
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
			$("button[name='start']").click(function(){
				window.location = "makeplanchage?file="+$(this).attr('url');
			})

			$("button[name='corrige']").click(function(){
				window.open("makecorrection?file="+$(this).attr('url'));
			})			
		</script>

		<?include_once "footer.php";?>
	</body>
</html>