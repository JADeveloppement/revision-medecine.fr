<html>
	<head>
		<title>Démocrite PACES - Nous contacter</title>
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

		<div class="container-fluid pt-5 pl-3">
			<h3 class="text-success font-weight-bold">Formulaire de contact</h3>
			<br>
			<div class="col">
				<div class="col">
					<div class="row">
						<div class="col"><input type="text" id="nom" class="form-control mb-3" placeholder="Nom"></div>
						<div class="col"><input type="text" id="prenom" class="form-control mb-3" placeholder="Prénom"></div>
						<div class="col"><input type="text" id="mail" class="form-control mb-3" placeholder="E-mail"></div>
					</div>
				</div>
				<div class="col">
					<select class="custom-select mb-3" id="sujet">
						<option selected>La formation</option>
						<option>Le site internet</option>
						<option>La PACES</option>
						<option>Autre question</option>
					</select>
				</div>
				<div class="col">
					<textarea class="form-control mb-3" id="message" style="height: 15rem; resize: none;"></textarea>
				</div>
				<div class="col"><button class="btn btn-success d-flex align-items-center" id="sendmessage"><span class="material-icons mr-3">mail</span> Envoyer</button></div>
			</div>
			<hr class="mt-3 mb-3">
			<span class="small text-muted text-center">Conformément à la loi Informatique et Libertés, les informations récoltées feront l'objet d'un traitement statistique interne à nos usages : ils ne sont en aucun revendus, redistribués, partiellement ou entièrement, à des tiers sans votre accord.</span>
			<hr class="mt-3 mb-3">
		</div>

		<?include_once "footer.php";?>

		<script>
			$("#sendmessage").click(function(){
				bad = false;
				if ($("#nom").val().length == 0){
					$("#nom").addClass("border-danger");
					bad = true;
				} else $("#nom").removeClass("border-danger");
				if ($("#prenom").val().length == 0){
					$("#prenom").addClass("border-danger");
					bad = true;
				} else $("#prenom").removeClass("border-danger");
				if ($("#mail").val().length == 0){
					$("#mail").addClass("border-danger");
					bad = true;
				} else $("#mail").removeClass("border-danger");
				if ($("#message").val().length == 0){
					$("#message").addClass("border-danger");
					bad = true;
				} else $("#message").removeClass("border-danger");
				if (!bad){
					var nom = $("#nom").val(), prenom = $("#prenom").val(), mail = $("#mail").val(), sujet = $("#sujet").children("option:selected").html(), message = $("#message").val().replace(/\n/g, "<br>");;

					$.post(
						'functions.php',
						{action: 5, nom: nom, prenom: prenom, mail: mail, sujet: sujet, message: message},
						function (data){
							alert("Merci pour votre message, une réponse vous sera fournie dans les meilleure délai.");
							$("#nom").val('');
							$("#prenom").val('');
							$("#mail").val('');
							$("#message").val('');
						}
					);
				}
			})
		</script>
	</body>
</html>