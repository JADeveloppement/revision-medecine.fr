<?
	$salt = "2019paces";
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");
	else {
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$identite = explode("2019paces", trim(fgets(fopen("../bddusers/$username", "r"))));
		$possede = false;

		$f = fopen("listecoursfiche", "r");
		$trouve = false;
		$ref = "aucun";
		while(!$trouve && ($line = fgets($f)) !== false){
			if (strpos(trim($line), $_GET['value']) !== false){
				$trouve = true;
				$ref = (explode("2019paces", trim($line)))[2];
			}
		}
		fclose($f);

		//echo "Référence : $ref <br>";
		if (strpos(strtolower($_GET['titre']), "aperçu") !== false){
			$possede = true;
		}
		else {
			if ($identite[13] == 3)
				$possede = true;
			else if ($identite[13] == 1 && (strpos($_GET['titre'], "UE1") !== false || strpos($_GET['titre'], "UE2") !== false || strpos($_GET['titre'], "UE3A") !== false || strpos($_GET['titre'], "UE4") !== false))
				$possede = true;
			else if ($identite[13] == 2 && (strpos($_GET['titre'], "UE3B") !== false || strpos($_GET['titre'], "UE5") !== false || strpos($_GET['titre'], "UE6") !== false || strpos($_GET['titre'], "UE7") !== false)){
				$possede = true;
			}
			else if ($identite[13] == 0){
				$listecoursuser = trim(fgets(fopen("../bddusers/cours/$username", "r")));
				if (strpos($listecoursuser, $ref) !== false)
					$possede = true;//echo "Il possède : $listecoursuser && $ref<br>";
				else $possede = false;//echo "Il ne possède pas : $listecoursuser && $ref<br>";
			}
		}
	}
?>
<html>
	<head>
		<title>D-Learning - <?echo $_GET['titre'];?></title>
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
			<ul class="list-group container-fluid w-100 mb-4" style="border-style: solid !important; border-width: 2px !important; border-color: black !important;">
				<li class="list-group-item list-group-item-light font-weight-bold"><?echo $_GET['titre'];?></li>
				<li class="list-group-item list-group-item-warning">Pour commander ce cours en version papier, veuillez nous contacter par mail : contact@revision-medecine.fr</li>
			</ul>
			<?
				if (!$possede){
					?>
					<ul class="list-group">
						<li class="list-group-item bg-dark text-white h5">Informations</li>
						<li class="list-group-item">Selon notre base de données, vous n'êtes pas sensé(e) avoir accès à ce cours. Si c'est une erreur, et que ce message persiste, veuillez contacter notre équipe par mail : contact@revision-medecine.fr</li>
					</ul>
					<?
				}
				else {
					?>
					<iframe style="margin-top: -8%;" src="https://drive.google.com/file/d/<?echo $_GET['value'];?>/preview" width="100%" height="100%"></iframe>
					<?
				}
			?>
		</div>

		<?include_once "footer.php";?>
	</body>
</html>