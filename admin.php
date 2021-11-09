<?
	if (!isset($_GET['action']))
		header("Location: /");
	else if (intval($_GET['action']) != 743)
		header("Location: /");

	$listep1 = scandir("paces/bddusers/");
	$listeecn = scandir("ecn/bddusers/");
	$nbinscrits = [0,0];
	foreach($listep1 as $i)
		if (strlen($i) >= 4 && strpos($i, "index") === false && strpos($i, ".lock") === false)
			$nbinscrits[0]++;

	foreach($listeecn as $i)
		if (strlen($i) >= 4 && strpos($i, "index") === false && strpos($i, ".lock") === false)
			$nbinscrits[1]++;
?>
<html>
	<head>
		<title>Révisions Médecine - Administration</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.75">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- ICONES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

		<header class="navbar navbar-expand navbar-dark bg-dark text-white flex-column flex-md-row bd-navbar">
			<nav class="navbar navbar-expand-lg navbar-dark text-white">
				<h2 class="navbar-brand mr-2" style="font-size: 1.8rem;">Administration</h2>
				<div class="navbar-nav-scroll">
					<ul class="navbar-nav bd-navbar-nav flex-row">
						
					</ul>
				</div>
			</nav>
		</header>
		<div class="col">
			<ul class="list-group mt-4 mb-4">
				<li class="list-group-item bg-dark text-white h4">Liste des utilisateurs<span class="float-right small"><b>PACES</b><span class="badge badge-secondary"><?echo $nbinscrits[0];?></span> <b> ECN</b><span class="badge badge-secondary"><?echo $nbinscrits[1];?></span></span></li>
				<li class="list-group-item bg-light text-muted">
					<div class="row">
						<!--<div class="col">Site</div>-->
						<div class="col">Identité</div>
						<div class="col">E-mail</div>
						<div class="col">Offre (S/P/C)</div>
						<div class="col">Inscription</div>
					</div>
				</li>
				<?
				foreach($listep1 as $i){
					if (!is_dir("paces/bddusers/$i")){
						$f = fopen("paces/bddusers/".$i, "r");
						$a = explode("2019paces", trim(fgets($f))); $b = trim(fgets($f)); $b = trim(fgets($f));
						echo "<li class='list-group-item'><div class='row'>";
							//echo "<div class='col'>PACES</div>";
							echo "<div class='col'>".strtoupper($a[0])." ".$a[1]."</div>";
							echo "<div class='col'>".$a[3]."</div>";
							echo "<div class='col'>".$a[11]."/".$a[12]."/".$a[13]."/".$a[14]."€</div>";
							echo "<div class='col'>".date("d/m/Y", $b)."</div>";
						echo "</div></li>";
						fclose($f);
					}
				}
				/*
				foreach($listeecn as $i){
					if (strlen($i) >= 4 && strpos($i, "index") === false && strpos($i, ".lock") === false){
						$f = fopen("ecn/bddusers/".$i, "r");
						$a = fgets($f); $a = explode("2019ecn", trim(fgets($f))); $b = trim(fgets($f));
						echo "<li class='list-group-item'><div class='row'>";
							echo "<div class='col'>ECN</div>";
							echo "<div class='col'>".strtoupper($a[0])." ".$a[1]."</div>";
							echo "<div class='col'>".$a[4]."</div>";
							echo "<div class='col'>".$a[5]."</div>";
							echo "<div class='col'>".$a[6]."</div>";
							echo "<div class='col'>".date('j/n/Y', $a[7])."</div>";
							echo "<div class='col'>";
							if (strpos(strtolower($b), "-1") !== false)
								echo "<button class='btn btn-outline-danger'>Non payé</button></div>";
							else echo "<button class='btn btn-outline-success'>Payé</button></div>";
							if (file_exists("ecn/bddusers/".$i.".lock"))
								echo "<div class='col'>".trim(fgets(fopen("ecn/bddusers/".$i.".lock", 'r')))."</div>";
							else echo "<div class='col'>Pas encore connecté</div>";
						echo "</div></li>";
						fclose($f);
					}
				}*/
				?>
			</ul>

			<ul class="list-group mb-4">
				<li class="list-group-item bg-dark text-white h4">Liste des questions</li>
				<li class="list-group-item bg-light text-muted">
					<div class="row">
						<div class="col">Site</div>
						<div class="col">Nom</div>
						<div class="col">Prénom</div>
						<div class="col">E-mail</div>
						<div class="col">Sujet</div>
						<div class="col">Date</div>
						<div class="col">-</div>
					</div>
				</li>
				<?
				$qecn = scandir("ecn/contact/");
				foreach($qecn as $i){
					if (strlen($i) >=  4){
						$date = date('j/n/Y H:m', $i);
						$donnees = explode("2019ecn", trim(fgets(fopen("ecn/contact/".$i, "r"))));
						echo "<li class='list-group-item'>";
							echo "<div class='row'>";
								echo "<div class='col'>ECN</div>";
								echo "<div class='col'>".$donnees[0]."</div>";
								echo "<div class='col'>".$donnees[1]."</div>";
								echo "<div class='col'>".$donnees[2]."</div>";
								echo "<div class='col'>".$donnees[3]."</div>";
								echo "<div class='col'>".$date."</div>";
								echo "<div class='col'><button class='btn btn-primary material-icons btn-sm' data-toggle='collapse' data-target='#q$i'>remove_red_eye</button></div>";
							echo "</div>";
						echo "</li>";
						echo "<li class='list-group-item collapse bg-light text-muted' id='q$i'>".$donnees[4]."</li>";
					}
				}

				$qecn = scandir("paces/contact/");
				foreach($qecn as $i){
					if (strlen($i) >=  4){
						$date = date('j/n/Y H:m', $i);
						$donnees = explode("2019paces", trim(fgets(fopen("paces/contact/".$i, "r"))));
						echo "<li class='list-group-item'>";
							echo "<div class='row'>";
								echo "<div class='col'>PACES</div>";
								echo "<div class='col'>".$donnees[0]."</div>";
								echo "<div class='col'>".$donnees[1]."</div>";
								echo "<div class='col'>".$donnees[2]."</div>";
								echo "<div class='col'>".$donnees[3]."</div>";
								echo "<div class='col'>".$date."</div>";
								echo "<div class='col'><button class='btn btn-primary material-icons btn-sm' data-toggle='collapse' data-target='#q$i'>remove_red_eye</button></div>";
							echo "</div>";
						echo "</li>";
						echo "<li class='list-group-item collapse bg-light text-muted' id='q$i'>".$donnees[4]."</li>";
					}
				}
				?>
			</ul>
			<button class="btn btn-primary material-icons" onclick="window.location = '/';">home</button>
		</div>
	</body>
</html>