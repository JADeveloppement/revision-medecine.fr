<?
	$salt = "2019paces";
	if (!isset($_COOKIE['PACES-DEMOCRITE']))
		header("Location: https://revision-medecine.fr/paces/");
	else {
		$username = $_COOKIE['PACES-DEMOCRITE'];
		$identite = explode("2019paces", fgets(fopen("../bddusers/$username", "r")));

		if ($identite[12] != 0 || strpos($_GET['file'], "free") !== false){
			$file = $_GET['file'];

			if (!file_exists("participation/".$username))
				fopen("participation/".$username, "w");
			else {
				$f = fopen("participation/".$username, "r");
				$l = "";
				while (($line = fgets($f)) !== false)
					if (strpos(trim($line), $file) === false)
						$l .= trim($line)."\n";
				fclose($f);
				fputs(fopen("participation/".$username, "w"), $l);
			}

			$f = fopen("planchagedispo/".$file, "r");
			$line = fgets($f); $line = fgets($f);
			$qcm = array();
			while (($line = fgets($f)) !== false)
				array_push($qcm, trim($line));
		}
	}
?>
<html>
	<head>
		<title>D-Learning - Planchage</title>
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

		<? if ($identite[12] == 0 && strpos($_GET['file'], "free") === false){
			?>
		<div class="container-fluid mt-4 mb-4">
			<ul class="list-group">
				<li class="list-group-item bg-dark text-white h5">Informations</li>
				<li class="list-group-item list-group-item-warning">Vous n'êtes pas abonné pour ce planchage. Si vous voyez ce message alors que vous êtes bien abonné, veuillez nous contacter rapidement par mail : contact@revision-medecine.fr</li>
			</ul>
		</div>
			<?
		} else {?>

		<div class="container-fluid mt-4 mb-4">
				<?
				$q = 1;
				foreach($qcm as $i){
					echo "<ul class='list-group mb-3'>";
						echo "<li class='list-group-item bg-dark text-white h5'>Question $q</li>";
							$a = explode("2019paces", $i);
							foreach ($a as $b) {
								if (strpos($b, "777paces") !== false){
									$c = explode("777paces", $b);
									foreach($c as $d){
										$lettre = substr($d, 0, 1);
										$reste = substr($d, 3, strlen($d));
										echo "<li class='list-group-item'>";
											echo "<div class='form-check form-check-inline d-flex align-items-center'>";
												echo "<span class='form-check-inline' for='prop$lettre$q'>$lettre</span>";
												echo "<input class='form-check-input' type='checkbox' id='prop$lettre$q' name='proposition' value='question$q'>";
												echo "<label class='form-check-label' for='prop$lettre$q'>$reste</label>";
											echo "</div>";
										echo "</li>";
									}
								}
								else {
									echo "<li class='list-group-item'>$b</li>";
								}
							}
							
					echo "</ul>";

					$q++;
				}
				?>
		</div>

		<div class="card shadow" style="width: 18rem; position: fixed; bottom: 1rem; right: 1rem;">
			<div class="card-body">
				<div class="col">
					<div class="col">
						<div class="row">
							<div class="col-md-auto centre material-icons">timer</div>
							<div class="col-md-auto centre" id="chrono"></div>
						</div>
					</div>
					<hr>
					<div class="col">
						<div class="col centre"><button id="corriger" class="btn btn-warning">Envoyer</button></div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var h = 1, min = 10, sec = 0, txth = "", txtmin = "", txts = "", id, tempsimparti = false;
				function chrono(){
					if (sec < 10) txts = "0"+sec+"s";
					else txts = sec+"s";
					if (min == 0) txtmin = "";
					else if (min < 10) txtmin = "0"+min+"min";
					else txtmin = min+"min";
					if (h == 0) txth = "";
					else if (h < 10) txth = "0"+h+"h";
					else txth = h+"h";
					$("#chrono").html(txth+" "+txtmin+" "+txts);
					if (tempsimparti){
						clearInterval(id);
						alert("Temps imparti écoulé.");
						$("input[type='checkbox']").each(function(){
							$(this).attr('disabled', true);
						})
					}
					else {
						sec--;
						if (sec <= 0){
							if (min == 0 && h == 0)
								tempsimparti = true;
							else {
								sec = 59;
								min--;
								if (min < 0){
									h--;
									if (h <= 0) 
										h = 0;
									min = 59;
								}
							}
						}
					}
				}
				id = setInterval(chrono, 1000);

				$("#corriger").click(function(){
					var last = "question1", rep = "", salt = "2019paces", indice = 0;
					$("input[type='checkbox']").each(function(){
						if (last != $(this).attr("value")){
							rep+=salt;
							console.log("Proposition "+last+" : "+rep);
							last = $(this).attr("value");
						}
						if ($(this).is(":checked"))
							rep += "1";
						else rep += "0";
						
					})
					$.post(
						'functions.php',
						{action: 5, eleve: rep, file: "<?echo $_GET['file'];?>"},
						function (data){
							alert("Consultez votre note sur le corrigé de ce planchage. Vous serez redirigé vers la page principale.");
							window.location = "planchage.php";
						}, 'text'
					);
				})
		</script>

		<?}?>

		<?include_once "footer.php";?>
	</body>
</html>