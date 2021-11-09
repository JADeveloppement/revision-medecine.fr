<?
	$salt = "2019paces";
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");
	else {
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$file = $_GET['file'];

		$copie = array();
		$f = fopen("participation/$username", "r");
		$trouve = false;
		while(!$trouve && ($line = fgets($f)) !== false){
			if (strpos(trim($line), $file) !== false){
				$trouve = true;
				$copie = explode("2019paces", trim($line));
			}
		}

		if ($trouve){
			$f = fopen("planchagedispo/".$file, "r");
			$line = fgets($f); $corrige = explode("2019paces", trim(fgets($f)));
			$qcm = array();
			while (($line = fgets($f)) !== false)
				array_push($qcm, trim($line));

			$notemax = count($corrige);
			$note = round((($copie[(sizeof($copie)-1)]*20)/$notemax), 2);
			if ($note > 20) $note = 20;
		}
	}
?>
<html>
	<head>
		<title>D - Learning - Correction</title>
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

		<div class="container-fluid mt-4 mb-4">
			<ul class="list-group mb-4">
				<li class="list-group-item bg-dark text-white h5">Informations</li>
				<li class="list-group-item list-group-item-success">Il n'y a pas de discordance entre votre réponse et le corrigé</li>
				<li class="list-group-item list-group-item-danger">Il y a une discordance entre votre réponse et le corrigé</li>
			</ul>
				<?
				if (!$trouve){
					?>
					<ul class="list-group mb-4">
						<li class="list-group-item">Vous n'êtes pas sensé visualiser la correction de ce planchage. Participez au planchage et retournez la copie pour pouvoir en bénéficier. Si vous voyez ce message par erreur, et que le message persiste, veuillez nous contacter rapidement par mail : contact@revision-medecine.fr</li>
					</ul>
					<?
				} else {
					$q = 1;
					foreach($qcm as $i){
						echo "<ul class='list-group mb-3'>";
							echo "<li class='list-group-item bg-dark text-white h5'>Question $q</li>";
								$a = explode("2019paces", $i);
								$matrice = $corrige[$q-1];
								foreach ($a as $b) {
									if (strpos($b, "777paces") !== false){
										$c = explode("777paces", $b);
										$indice = 0;
										foreach($c as $d){
											if ($matrice[$indice] == "1")
												$vf = "VRAIE";
											else if ($matrice[$indice] == "0") 
												$vf = "FAUSSE";
											if ($matrice[$indice] == $copie[$q][$indice])
												$color = "success";
											else $color = "danger";
											
											if ($copie[$q][$indice] == '1')
												$checked = "checked";
											else $checked = "";

											$lettre = substr($d, 0, 1);
											$reste = substr($d, 3, strlen($d));
											echo "<li class='list-group-item list-group-item-$color'>";
												echo "<div class='form-check form-check-inline d-flex align-items-center'>";
													echo "<span class='form-check-inline' for='prop$lettre$q'>$lettre</span>";
													echo "<input class='form-check-input' type='checkbox' id='prop$lettre$q' $checked disabled>";
													echo "<label class='form-check-label' for='prop$lettre$q'>$reste <b>(Proposition $vf)</b></label>";
												echo "</div>";
											echo "</li>";
											$indice++;
										}
									}
									else {
										echo "<li class='list-group-item'>$b</li>";
									}
								}
						echo "</ul>";

						$q++;
					}
				}
				?>
		</div>

		<div class="card shadow" style="width: 18rem; position: fixed; bottom: 1rem; right: 1rem;">
			<div class="card-body">
				<div class="col">
					<div class="col">
						<div class="row">
							<div class="col-md-auto centre material-icons">assignment_turned_in</div>
							<div class="col-md-auto centre"><?echo $note."/20"; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?include_once "footer.php";?>
	</body>
</html>