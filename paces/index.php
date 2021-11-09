<html>
	<head>
		<title>Démocrite PACES - Accueil</title>
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

		<div class="container-fluid" id="desktop">
			<div class="row d-flex flex-column mb-4" style="background-image: url('img/img4.jpg');">
				<div class="col d-flex align-items-center justify-content-center">
					<div class="card shadow mt-4 mb-4 border-success" style="max-width: 65%;">
						<div class="card-body text-center mb-4">
							<h5 class="card-title">Préparation PACES</h5>
							<div class="card-text">
								<p>Préparez vous au concours de la PACES comme aucun autre : suivez vos révisions, utilisez les supports rédigés par les étudiants eux-même ayants réussi le concours, et entrainez-vous entre vous pour pouvoir avancer à votre rythme sans perdre de vue votre objectif avec cette plateforme de suivie inédite.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col d-flex align-items-center justify-content-center">
					<div class="card shadow mt-4 mb-4 border-success" style="max-width: 65%;">
						<div class="card-body text-center">
							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<ul class="list-group mb-2">
											<li class="list-group-item list-group-item-success h4">Consultez nos planchages</li>
										</ul>
										<img class="d-block mx-auto rounded shadow w-75" src="img/img1.png">
									</div>
									<div class="carousel-item">
										<ul class="list-group mb-2">
											<li class="list-group-item list-group-item-success h4">Entrainez-vous chez vous
											</li>
										</ul>
										<img class="d-block mx-auto rounded shadow w-75" src="img/img2.png">
									</div>
									<div class="carousel-item">
										<ul class="list-group mb-2">
											<li class="list-group-item list-group-item-success h4">Consultez les corrigés</li>
										</ul>
										<img class="d-block mx-auto rounded shadow w-75" src="img/img3.png">
									</div>
									<div class="carousel-item">
										<ul class="list-group mb-2">
											<li class="list-group-item list-group-item-success h4">Consultez nos supports de cours</li>
										</ul>
										<img class="d-block mx-auto rounded shadow w-75" src="img/img5.png">
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Précédent</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Suivant</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="mobile">
			<div class="row" style="background-image: url('img/img4.jpg');">
				<div class="col centre">
					<div class="card shadow mt-4 mb-4 border-success" style="max-width: 65%;">
						<div class="card-body text-center">
							<h5 class="card-title">Préparation PACES</h5>
							<div class="card-text">
								<p>Pensé par un étudiant en médecine, pour les étudiants en médecine.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row d-flex justify-content-center">
				<div id="carouselExampleIndicators" class="carousel slide mt-4 mb-4" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<ul class="list-group mb-2">
								<li class="list-group-item list-group-item-success text-center h5">Suivez vos tours de révisions</li>
							</ul>
							<img class="d-block mx-auto rounded shadow w-100" src="img/img1.png">
						</div>
						<div class="carousel-item">
							<ul class="list-group mb-2">
								<li class="list-group-item list-group-item-success text-center h5">Suivez vos cours relus</li>
							</ul>
							<img class="d-block mx-auto rounded shadow w-100" src="img/img2.png">
						</div>
						<div class="carousel-item">
							<ul class="list-group mb-2">
								<li class="list-group-item list-group-item-success text-center h5">Parmi les 156h de cours du 1er semestre</li>
							</ul>
							<img class="d-block mx-auto rounded shadow w-100" src="img/img3.png">
						</div>
						<div class="carousel-item">
							<ul class="list-group mb-2">
								<li class="list-group-item list-group-item-success text-center h5">Et plus encore (planchage, concours classés, cours...)</li>
							</ul>
							<img class="d-block mx-auto rounded shadow w-100" src="img/img5.jpg">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Précédent</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Suivant</span>
					</a>
				</div>
			</div>
		</div>

		<script>
			if (/Mobi|Android/i.test(navigator.userAgent)) {
			    //alert("La navigation sur téléphone portable n'est pas optimisée. Consultez notre site internet sur un ordinateur pour une meilleure expérience d'utilisation.");
			    $("#desktop").empty();
			}
			else {
				$("#mobile").empty();
			}
		</script>

		<?include_once "footer.php";?>
	</body>
</html>