<html>
	<head>
		<title>Démocrite PACES - Inscription</title>
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
	<body class="bg-white">
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
		<!-- SANDBOX <script  src="https://www.paypal.com/sdk/js?client-id=AQpk_wnJIkBChrUr9IjdNd0ukcq82VBaxaoup_fPXaYXHuO_LZTzrr8k6XbtXhEbmlDbfmQd3K_b7n-F&currency=EUR"></script>-->

		<div class="modal fade" id="modalpayer" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle">Paiement</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="col">
							<ul class="list-group mt-4 mb-4">
								<li class="list-group-item list-group-item-success h4">Récapitulatif</li>
								<li class="list-group-item" id="recap"></li>
								<li class="list-group-item list-group-item-success h5" id="prix"></li>
								<li class="list-group-item" id="liconfirm"><input class="form-control" id="confirmpassword" type="password" placeholder="Confirmer votre mot de passe"></li>
								<li class="list-group-item"><button class="btn btn-warning" id="confirmer">Confirmer</button></li>
								<li class="list-group-item d-flex justify-content-center sr-only" id="paiement"></span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid pt-5 pl-3">
			<h3 class="text-success font-weight-bold">Identité civile</h3>
			<br>

			<!-- VUE BUREAU  -->
			<div class="col" id="desktop">
				<div class="col">
					<div class="row mb-3">
						<div class="col"><input id="nom" class="form-control" type="text" placeholder="Nom"></div>
						<div class="col"><input id="prenom" class="form-control" type="text" placeholder="Prénom"></div>
						<div class="col"><input id="ddn" class="form-control" type="date" value="2000-01-01"></div>
						<div class="col"><input id="mail" class="form-control" type="mail" placeholder="E-mail"></div>
					</div>
				</div>
				<div class="col mb-3"><input id="adresse" class="form-control" type="text" placeholder="Adresse"></div>
				<div class="col mb-3">
					<div class="row">
						<div class="col"><input id="codepostale" class="form-control" type="text" placeholder="Code Postale"></div>
						<div class="col"><input id="ville" class="form-control" type="text" placeholder="Ville"></div>
						<div class="col"><input id="tel" class="form-control" type="text" placeholder="Numéro de téléphone"></div>
					</div>
				</div>
				<div class="col"><input id="passwordinscription" class="form-control" type="password" placeholder="Mot de passe D-learning"></div>
			</div>
			<!-- VUE BUREAU  -->

			<!-- VUE MOBILE  -->
			<div class="col" id="mobile">
				<div class="col">
					<div class="row">
						<div class="col mb-3"><input id="nom" class="form-control" type="text" placeholder="Nom"></div>
						<div class="col mb-3"><input id="prenom" class="form-control" type="text" placeholder="Prénom"></div>
					</div>
				</div>
				<div class="col">
					<div class="row">
						<div class="col mb-3"><input id="ddn" class="form-control" type="date" value="2000-01-01"></div>
						<div class="col mb-3"><input id="mail" class="form-control" type="mail" placeholder="E-mail"></div>
					</div>
				</div>
				<div class="col mb-3"><input id="adresse" class="form-control" type="text" placeholder="Adresse"></div>
				<div class="col">
					<div class="row">
						<div class="col mb-3"><input id="codepostale" class="form-control" type="number" placeholder="Code Postale"></div>
						<div class="col mb-3"><input id="ville" class="form-control" type="text" placeholder="Ville"></div>
					</div>
				</div>
				<div class="col mb-3"><input id="tel" class="form-control" type="number" placeholder="Numéro de téléphone"></div>
				<div class="col mb-3"><input id="passwordinscription" class="form-control" type="password" placeholder="Mot de passe D-learning"></div>
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
			<!-- VUE MOBILE  -->


			<hr class="mt-3 mb-3">
			<h3 class="text-success font-weight-bold">Votre scolarité</h3>
			<br>
			<div class="col">
				<div class="col">
					<div class="row mb-3">
						<div class="col"><input class="form-control" id="bacserie" type="text" placeholder="Baccalauréat Série"></div>
						<div class="col">
							<select class="custom-select" id="mention">
								<option selected>Aucune mention</option>
								<option>Assez bien</option>
								<option>Bien</option>
								<option>Très bien</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<h3 class="text-success font-weight-bold">Votre choix</h3>
			<br>
			<!--<div class="row mb-4">
				<div class="col centre">
					<div class="card shadow" style="width: 18rem;">
						<div class="card-body d-flex justify-content-center flex-column">
							<h5 class="card-title font-weight-bold">Pack MAJOR</h5>
							<ul class="list-group">
								<li class="list-group-item">Supports de cours Annuel</li>
								<li class="list-group-item">Les planchages Annuel <span class="small small">(2 planchages/semaines, 1 concours/mois)</span></li>
								<li class="list-group-item list-group-item-success font-weight-bold">Tarif : 950€</li>
							</ul>
							<button class="btn btn-success mt-3" id="packmajor">Choisir ce pack</button>
						</div>
					</div>
				</div>
				<div class="col centre">
					<div class="card shadow" style="width: 18rem;">
						<div class="card-body d-flex justify-content-center flex-column">
							<h5 class="card-title font-weight-bold">Pack ESSENTIEL</h5>
							<ul class="list-group">
								<li class="list-group-item">Supports de cours Annuel</li>
								<li class="list-group-item">Les planchages Annuel <span class="small small">(2 planchages/semaines)</span></li>
								<li class="list-group-item list-group-item-success font-weight-bold">Tarif : 820€</li>
							</ul>
							<button class="btn btn-success mt-3" id="packessentiel">Choisir ce pack</button>
						</div>
					</div>
				</div>
			</div>-->
			<div class="row">
				<div class="col centre mb-4">
					<div class="card shadow" style="max-width: 80%;">
						<div class="card-body d-flex justify-content-center flex-column">
							<h5 class="card-title text-danger font-weight-bold text-center">OFFRE SPECIALE REVISIONS</h5>
							<ul class="list-group">
								<li class="list-group-item">Supports de cours Semestre 1</li>
								<li class="list-group-item">Planchages révisions (33planchages)</li>
								<li class="list-group-item list-group-item-success font-weight-bold">Tarif : 300€ (-10€)</li>
							</ul>
							<button class="btn btn-success mt-3" id="pack1offre">Choisir ce pack</button>
						</div>
					</div>
				</div>
				<div class="col centre mb-4">
					<div class="card shadow" style="max-width: 80%;">
						<div class="card-body d-flex justify-content-center flex-column">
							<h5 class="card-title text-danger font-weight-bold text-center">OFFRE SPECIALE REVISIONS</h5>
							<ul class="list-group">
								<li class="list-group-item">Planchages révisions</li>
								<li class="list-group-item list-group-item-success font-weight-bold">Tarif : 60€</li>
							</ul>
							<button class="btn btn-success mt-3" id="offreseule">Choisir cette offre</button>
						</div>
					</div>
				</div>
			</div>

			<ul class="list-group" id="alacarte">
				<li class="list-group-item list-group-item-success font-weight-bold">A la carte</li>
				<li class="list-group-item list-group-item-warning small">Il vous sera possible de vous abonner depuis votre profil si vous souhaitez accéder à la plateforme sans payer.<br><b>Nous sommes actuellement en Décembre 2019, les offres "Semestre 1" (et donc "Annuel" par la même occasion) pour les Planchages (avec/sans/uniquement concours, sauf offre spéciale) ne sont, naturellement, plus disponibles.</b></li>
				<li class="list-group-item small"></li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-3">Suivi des cours :</div>
						<div class="col">
							<select class="custom-select" name="choix">
								<option value="choix0">Aucun</option>
								<option value="choix1">Semestre 1 (7€)</option>
								<option value="choix2">Semestre 2 (10€)</option>
								<option value="choix3">Annuel (15€)</option>
							</select>
						</div>
					</div>					
				</li>
				<li class="list-group-item" name="pconcours">
					<div class="row">
						<div class="col-3">Planchage (avec concours) :</div>
						<div class="col">
							<select class="custom-select" name="choix">
								<option value="choixA">Aucun</option>
								<!--<option value="choix4">Semestre 1 (200€)</option>-->
								<option value="choix5">Semestre 2 (250€)</option>
								<!--<option value="choix6">Annuel (400€)</option>-->
							</select>
						</div>
					</div>
				</li>
				<li class="list-group-item" name="pSconcours">
					<div class="row">
						<div class="col-3">Planchage (sans concours) :</div>
						<div class="col">
							<select class="custom-select" name="choix">
								<option value="choixB">Aucun</option>
								<option value="choix7">Offre spéciale (60€)</option>
								<option value="choix8">Semestre 2 (180€)</option>
								<option value="choix9">Annuel (230€)</option>
							</select>
						</div>
					</div>
				</li>
				<li class="list-group-item" name="concours">
					<div class="row">
						<div class="col-3">Concours :</div>
						<div class="col">
							<select class="custom-select" name="choix">
								<option value="choixC">Aucun</option>
								<!--<option value="choix10">Semestre 1 (70€)</option>-->
								<option value="choix11">Semestre 2 (70€)</option>
								<!--<option value="choix12">Annuel (130€)</option>-->
							</select>
						</div>
					</div>
				</li>
				<li class="list-group-item"> 
					<div class="row">
						<div class="col-3">Supports de cours :</div>
						<div class="col">
							<select class="custom-select" name="choix">
								<option value="choixD">Aucun</option>
								<option value="choix13">Semestre 1 (250€)</option>
								<option value="choix14">Semestre 2 (300€)</option>
								<option value="choix15">Annuel (500€)</option>
							</select>
						</div>
					</div>
				</li>
			</ul>
			<div class="col d-flex align-items-center justify-content-center mt-4 mb-4">
				<ul class="list-group">
					<li class="list-group-item list-group-item-success" id="total">Total : 0€</li>
					<li class="list-group-item"><button class="btn btn-success" id="payer">S'inscrire et payer</button></li>
				</ul>
			</div>
			<hr class="mt-3 mb-3">
			<div class="col">
				<div class="col"><span class="small text-muted text-center">En vous inscrivant sur le site internet, vous acceptez les <a class="small" href="cgv.pdf" target="_blank">Conditions Générales de Vente et d'utilisation</a> du site internet Révision-Médecine.</span></div>
				<div class="col"><span class="small text-muted text-center">Conformément à la loi Informatique et libertés, les informations récoltées feront l'objet d'un traitement statistique interne à nos usages : ils ne sont en aucun revendus, redistribués, partiellement ou entièrement, à des tiers sans votre accord.</span></div>
			</div>
			<hr class="mt-3 mb-3">
		</div>

		<script  src="inscription_js.js"></script>

		<?include_once "footer.php";?>
	</body>
</html>