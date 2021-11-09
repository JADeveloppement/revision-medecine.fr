<?
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");

	$username = $_COOKIE['PACES-DEMOCRITE'];

	$listeplanchage = scandir("planchagedispo/");

	$categorie = [array(), array(), array(), array()];
	$categorieS2 = [array(), array(), array(), array()];

	$identite = explode("2019paces", fgets(fopen("../bddusers/$username", "r")));

	$texte = ["UE1 - Planchage Chimie Générale, organique, Bioénergétique, biomoléculaire", "UE2 - Planchage Biologie Cellulaire, histologie, embryologie", "UE3A - Planchage Physique appliquée à la médecine", "UE4MS - Planchage Mathématiques appliquées à la médecine"];

	$texteS2 = ["UE3B - Mécanique des fluides, équilibre acidobasique, transports membranaires, radioactivité", "UE5 - Anatomie", "UE6 - Pharmacologie", "UE7 - Santé, société, humanité"];

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

	$planchagefait = array();
	$nbplanchagefait = 0;
	if (file_exists("participation/".$username)){
		$f = fopen("participation/".$username, "r");
		while (($line = fgets($f)) !== false){
			$nbplanchagefait++;
			array_push($planchagefait, explode("2019paces", trim($line))[0]);
		}
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
				<ul class="list-group mb-4">
					<li class="list-group-item list-group-item-primary h5">Liste des plachages disponibles<span class="badge badge-secondary float-right"><? echo (count($listeplanchage)-4);  ?></span></li>
					<li class="list-group-item list-group-item-warning small">
						<b>Votre offre : </b>
						<?
						switch($identite[12]){
							case 0: echo "Aucun abonnement."; break;
							
							case 1: echo "Avec concours : Semestre 1"; break;
							case 2: echo "Avec concours : Semestre 2"; break;
							case 3: echo "Avec concours : Annuel"; break;

							case 4: echo "Sans concours : Semestre 1"; break;
							case 5: echo "Sans concours : Semestre 2"; break;
							case 6: echo "Sans concours : Annuel"; break;

							case 7: echo "Uniquement concours : Semestre 1"; break;
							case 8: echo "Uniquement concours : Semestre 2"; break;
							case 9: echo "Uniquement concours : Annuel"; break;

							default: echo "Non reconnue, veuillez nous contacter par mail (contact@revision-medecine.fr)";
							break;
						}
						?>
					</li>
					<?
					$a = 0;
					$indicetotal = 0;
					if ($identite[12] == 1 || $identite[12] == 3 || $identite[12] == 4 || $identite[12] == 6){
						foreach($categorie as $S1){
							echo "<li class='list-group-item alert-primary'>".$texte[$a]."<span class='float-right'><span class='badge badge-secondary'>".count($S1)."</span><button class='btn btn-light material-icons' data-toggle='collapse' data-target='#planchage$indicetotal'>remove_red_eye</button></span></li>";
							if (count($S1) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$indicetotal'>Aucun planchage pour cette catégorie</li>";
							} else {
								foreach($S1 as $pl){
									$res = fait($pl, $planchagefait);
									$titre = trim(fgets(fopen("planchagedispo/$pl", "r")));
									echo "<li class='list-group-item collapse' id='planchage$indicetotal'>";
										echo $titre;
										if ($res) echo "<span class='badge badge-success ml-2'>Fait</span>";
										echo "<span class='float-right'>";
											echo "<button class='btn btn-primary' name='start' url='$pl'>Commencer</button>";
											if ($res) echo "<button class='btn btn-success' name='corriger' url='$pl'>Correction</button>";
										echo "</span>";
									echo "</li>";
								}
							}
							$a++;
							$indicetotal++;
						}
					}

					else if ($identite[12] == 2 || $identite[12] == 3 || $identite[12] == 5 || $identite[12] == 6){
						$a = 0;
						foreach($categorieS2 as $S2){
							echo "<li class='list-group-item alert-primary'>".$texteS2[$a]."<span class='float-right'><span class='badge badge-secondary'>".count($S2)."</span><button class='btn btn-light material-icons' data-toggle='collapse' data-target='#planchage$indicetotal'>remove_red_eye</button></span></li>";
							if (count($S2) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$indicetotal' >Aucun planchage pour cette catégorie</li>";
							} else {
								foreach($S2 as $pl){
									$res = fait($pl, $planchagefait);
									$titre = trim(fgets(fopen("planchagedispo/$pl", "r")));
									echo "<li class='list-group-item collapse' id='planchage$indicetotal'>";
										echo $titre;
										if ($res) echo "<span class='badge badge-success ml-2'>Fait</span>";
										echo "<span class='float-right'>";
											echo "<button class='btn btn-primary' name='start' url='$pl'>Commencer</button>";
											if ($res) echo "<button class='btn btn-success' name='corriger' url='$pl'>Correction</button>";
										echo "</span>";
									echo "</li>";
								}
							}
							$a++;
							$indicetotal++;
						}
					}
					else if ($identite[13] == 0){
						foreach($categorie as $S1){
							echo "<li class='list-group-item alert-primary'>".$texte[$a]."<span class='float-right'><span class='badge badge-secondary'>".count($S1)."</span><button class='btn btn-light material-icons' data-toggle='collapse' data-target='#planchage$indicetotal'>remove_red_eye</button></span></li>";
							if (count($S1) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$indicetotal'>Aucun planchage pour cette catégorie</li>";
							} else {
								foreach($S1 as $pl){
									$res = fait($pl, $planchagefait);
									$titre = trim(fgets(fopen("planchagedispo/$pl", "r")));
									if (strpos($pl, "free") !== false){
										echo "<li class='list-group-item collapse' id='planchage$indicetotal'>";
											echo $titre;
											if ($res) echo "<span class='badge badge-success ml-2'>Fait</span>";
											echo "<span class='float-right'>";
												echo "<button class='btn btn-primary' name='start' url='$pl'>Commencer</button>";
												if ($res) echo "<button class='btn btn-success' name='corriger' url='$pl'>Correction</button>";
											echo "</span>";
										echo "</li>";
									}
								}
							}
							$a++;
							$indicetotal++;
						}

						$a = 0;
						foreach($categorieS2 as $S2){
							echo "<li class='list-group-item alert-primary'>".$texteS2[$a]."<span class='float-right'><span class='badge badge-secondary'>".count($S2)."</span><button class='btn btn-light material-icons' data-toggle='collapse' data-target='#planchage$indicetotal'>remove_red_eye</button></span></li>";
							if (count($S2) == 0){
								echo "<li class='list-group-item list-group-item-danger collapse' id='planchage$indicetotal' >Aucun planchage pour cette catégorie</li>";
							} else {
								foreach($S2 as $pl){
									$res = fait($pl, $planchagefait);
									$titre = trim(fgets(fopen("planchagedispo/$pl", "r")));
									if (strpos($pl, "free") !== false){
										echo "<li class='list-group-item collapse' id='planchage$indicetotal'>";
											echo $titre;
											if ($res) echo "<span class='badge badge-success ml-2'>Fait</span>";
											echo "<span class='float-right'>";
												echo "<button class='btn btn-primary' name='start' url='$pl'>Commencer</button>";
												if ($res) echo "<button class='btn btn-success' name='corriger' url='$pl'>Correction</button>";
											echo "</span>";
										echo "</li>";
									}
								}
							}
							$a++;
							$indicetotal++;
						}
					}
					?>
				</ul>

				<ul class="list-group mb-4">
					<li class="list-group-item list-group-item-primary">Concours</li>
					<li class="list-group-item">Concours 1 - UE3B UE5 UE6 <span class="badge badge-success small ml-4">10/02/2020</span><span class="float-right"><button class="btn btn-secondary mr-2" disabled>Commencer</button><button class="btn btn-success mr-2" disabled>Résultats</button></span></li>
				</ul>
			</div>
		</div>
		<!-- VUE BUREAU -->

		<script>
			$("button[name='start']").click(function(){
				window.location = "makeplanchage?file="+$(this).attr('url');
			})

			$("button[name='corriger']").click(function(){
				window.open("makecorrection?file="+$(this).attr('url'));
			})			
		</script>

		<?include_once "footer.php";?>
	</body>
</html>