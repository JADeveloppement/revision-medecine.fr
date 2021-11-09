<?php
	
	$deco = false;
	$exists = true;
	
	if (isset($_GET['act']) && strcmp($_GET['act'], "deconnection") == 0){
		setcookie("ECN-SUIVI-nom", "", 1);
		setcookie("ECN-SUIVI-var", "", 1);
		$deco = true;
	}
?>

<html>
	<head>
		<title>Démocrite ECN - Connexion</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=0.75">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- ICONES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- GOOGLE ANALYTICS -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151030460-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());  gtag('config', 'UA-151030460-1');</script>
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

		<!-- <header class="navbar navbar-expand navbar-dark bg-success flex-column flex-md-row bd-navbar">
			<nav class="navbar navbar-expand-lg navbar-dark text-white">
				<h2 class="navbar-brand mr-2" style="font-size: 1.8rem;">Démocrite 
				</h2>
				<div class="navbar-nav-scroll">
					<ul class="navbar-nav bd-navbar-nav flex-row">
						
					</ul>
				</div>
			</nav>
		</header> -->
		<nav class="navbar navbar-expand-lg navbar-light bg-success">
			<a class="navbar-brand d-flex align-items-center font-weight-bold text-white" href="#">
				<img src="img/logo.png" width="70" height="70" class="d-inline-block align-top" alt="">Démocrite
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<div class="col d-flex justify-content-center">
					<ul class="navbar-nav text-white">
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center text-white" href="index.php"><span class="material-icons mr-2">home</span>Accueil</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link d-flex align-items-center" href="laformation.php"><span class="material-icons mr-2">school</span>La formation</a>
						</li>
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center" href="inscription.php"><span class="material-icons mr-2">person_add</span>Inscription</a>
						</li>
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center" href="catalogue.php"><span class="material-icons mr-2">shopping_cart</span>Catalogue</a>
						</li>
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center" href="nouscontacter.php"><span class="material-icons mr-2">mail</span>Nous contacter</a>
						</li> -->
					</ul>
				</div>
				<span class="navbar-text">
					<button class="btn btn-light" id="plateformed" data-toggle="modal" data-target="#modalconnexion">Plateforme D-Learning</button>
				</span>
			</div>
		</nav>

		<div class="col">
			<div class="row d-flex align-items-center justify-content-center mb-4" style="background-image: url('img/logo.jpg');">
				<div class="card shadow mt-4 mb-4 border-success" style="max-width: 65%;">
					<div class="card-body text-center">
						<h5 class="card-title">Révisions Démocrite</h5>
						<div class="card-text">
							<p>D'abord créé par un étudiant en médecine pour suivre ses propres révisions, il a décidé de publier et mettre en ligne l'outil qu'il a lui même développé pour l'aider dans le suivi de ses révisions des items pour le concours des ECN. Cet outil fait par un étudiant, pour les étudiants, est pensé pour faciliter le suivi de son travail, aussi bien pour le nombre de relecture par item par module, que pour les items fichés (ou non) par module.<br>
							<br>
							Pas besoin de payer des cents et des milles pour s'offrir la chance de se faciliter le travail : une participation d'uniquement de 5€ vous permettra d'accéder à la plateforme. En effet, un serveur ainsi qu'une base de données ne sont malheureusement pas gratuits, de même pour l'hébergement ou son entretien. <br>Néanmoins, un accès illimité à la plateforme vous est possible pendant une durée de 7 jours, temps largement suffisant pour vous faire votre avis et adopter ou non celle-ci.</p>
							<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active"><img class="d-block mx-auto rounded shadow w-75" src="img/img1.png"></div>
									<div class="carousel-item"><img class="d-block mx-auto rounded shadow w-75" src="img/img2.png"></div>
									<div class="carousel-item"><img class="d-block mx-auto rounded shadow w-75" src="img/img3.png"></div>
									<div class="carousel-item"><img class="d-block mx-auto rounded shadow w-75" src="img/img4.png"></div>
								</div>
							</div>
						</div>
						<a class="card-link btn btn-success text-white mt-3 mb-3" href="#connexion">Se connecter</a>
					</div>
				</div>
			</div>

			<hr>
			<style>
				.centre {display: flex; align-items: center; justify-content: center;};
			</style>
			<div class="col">
				<div class="col d-flex align-items-center justify-content-center mb-4">
					<h3>Démocrite ECN c'est : <br></h3>
				</div>
				<div class="row">
					<div class="col">
						<div class="col centre"><h3><?echo 160+(count(scandir("bddusers/")));?></h3></div>
						<div class="col centre"><h1 class="material-icons" style="font-size: 4rem;">people_alt</h1></div>
						<div class="col centre"><h3>Etudiants inscrits</h3></div>
					</div>
					<div class="col">
						<div class="col centre"><h3>11</h3></div>
						<div class="col centre"><h1 class="card-title material-icons" style="font-size: 4rem;">insert_drive_file</h1></div>
						<div class="col centre"><h3>Modules</h3></div>
					</div>
					<div class="col">
						<div class="col centre"><h3>362</h3></div>
						<div class="col centre"><h1 class="card-title material-icons" style="font-size: 4rem;">edit</h1></div>
						<div class="col centre"><h3>Items ECN</h3></div>
					</div>
				</div>
			</div>
			<hr>

			<div class="col d-flex flex-column align-items-center mb-4">
				<div class="card shadow" id="connexion" style="width: 20rem;">
					<div class="card-body text-center">
						<h5 class="card-title">Connexion</h5>
						<div class="card-text">
							<input name="user" type="text" class="form-control mb-4" placeholder="Nom d'utilisateur">
							<input type="password" name="password" class="form-control mb-4" placeholder="Mot de passe">
							<div class="col">
								<div class="col"><button name="login" class="btn btn-outline-secondary mb-4" >Se connecter</button></div>
								<div class="col"><span class="sr-only" style="color: red;" name="erreur"></span></div>
							</div>
						</div>
						<a class="card-link" id="btninscrire">S'inscrire</a>
						<a class="card-link" id="btncontacter">Nous contacter</a>
					</div>
				</div>

				<div class="card shadow sr-only" id="inscription" style="width: 25rem;">
					<div class="card-body text-center">
						<h5 class="card-title">Inscription</h5>
						<div class="card-text">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text" id="">Nom et prénom</span>
								</div>
								<input type="text" id="nom" name="nom" class="form-control">
								<input type="text" name="prenom" id="prenom" class="form-control">
							</div>
							<input name="mail" type="e-mail" class="form-control mb-2" placeholder="E-mail">
							<input name="password" type="password" id="password" class="form-control mb-2" placeholder="Mot de passe">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="promo"><span class="material-icons" id="spanpromo">school</span></label>
								</div>
								<select class="custom-select" id="promo">
									<option selected></option>
									<option>DFGSM2</option>
									<option>DFGSM3</option>
									<option>DFASM1</option>
									<option>DFASM2</option>
									<option>DFASM3</option>
								</select>
							</div>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="ville"><span class="material-icons" id="spanlocation">my_location</span></label>
								</div>
								<select class="custom-select" id="ville">
									<option selected="selected"></option>
									<option>Sorbonne Université (ex UPMC)</option>
									<option>Université d'Angers</option>
									<option>Université de Aix Marseille</option>
									<option>Université de Bordeaux</option>
									<option>Université de Bourgogne</option>
									<option>Université de Brest</option>
									<option>Université de Caen</option>
									<option>Université de Clermont Auvergne</option>
									<option>Université de Franche-Comté</option>
									<option>Université de Grenoble - UGA</option>
									<option>Université de la Réunion</option>
									<option>Université de Lille</option>
									<option>Université de Lille Catho</option>
									<option>Université de Limoges</option>
									<option>Université de Lorraine</option>
									<option>Université de Lyon</option>
									<option>Université de Montpellier</option>
									<option>Université de Nantes</option>
									<option>Université de Nice-Sophia Antipolis</option>
									<option>Université de Paris 11 - Sud</option>
									<option>Université de Paris 12 - Créteil</option>
									<option>Université de Paris 13 - Bobigny</option>
									<option>Université de Paris 5 - Descartes</option>
									<option>Université de Paris  7 - Diderot</option>
									<option>Université de Picardie - Jules Verne</option>
									<option>Université de Poitiers</option>
									<option>Université de Reims</option>
									<option>Université de Rennes 1</option>
									<option>Université de Rouen</option>
									<option>Université de Saint-Etienne</option>
									<option>Université des Antilles et de la Guyane</option>
									<option>Université de Strasbourg</option>
									<option>Université de Toulouse</option>
									<option>Université de Tours</option>
									<option>Université de Versailles - UVSQ</option>
								</select>
							</div>
							<input name="login" type="text" class="form-control btn btn-outline-secondary mb-2" value="Votre login" readonly>
							<div class="col">
								<div class="col"><span class="mr-4" id="spaninscrit"></span><button name="save" class="btn btn-outline-secondary mb-2">Inscription</button></div>
								<div class="col"><span class="text-danger sr-only" name="erreurinscription"></span></div>
							</div>
						</div>
						<a class="card-link" id="btnseconnecter">Se connecter</a>
					</div>
				</div>

				<div class="card shadow sr-only" id="contacter" style="width: 20rem;">
					<div class="card-body text-center">
						<h5 class="card-title">Nous contacter</h5>
						<div class="card-text">
							<input type="text" name="nomcontact" class="form-control mb-2" placeholder="Nom">
							<input type="text" name="prenomcontact" class="form-control mb-2" placeholder="Prénom">
							<input type="text" name="mailcontact" class="form-control mb-2" placeholder="E-mail">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="sujetcontact"><span id="spansujet" class="material-icons">help</span></label>
								</div>
								<select class="custom-select" id="sujetcontact">
									<option selected></option>
									<option>Inscription</option>
									<option>Contenu</option>
									<option>Prix</option>
									<option>Un problème sur le site</option>
									<option>Autre</option>
								</select>
							</div>
							<textarea class="form-control mb-2" name="messagecontact" placeholder="Votre message en une simple question" style="resize: none;"></textarea>
							<div class="row d-flex align-items-center justify-content-center">
								<span class="mr-4" id="spancontact"></span><button id="sendcontact" class="btn btn-outline-secondary" >Envoyer</button>
								<button class="btn btn-outline-secondary ml-3" onclick="$('#contacter').addClass('sr-only'); $('#connexion').removeClass('sr-only').fadeIn();">Se connecter</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<div class="col d-flex align-items-center justify-content-center">
				<p class="text-muted small">Le site internet <a href="#">Révision-Médecine.fr</a> requiert l'utilisation des cookies. Ils sont récoltés par <a href="paypal.com" target="_blank">Paypal</a> une fois connecté pour le paiement du contenu payant, ainsi que par <a href="https://analytics.google.com/" target="_blank">Google Analytics</a> pour des questions de statistiques d'utilisation du site web. En navigant sur le site, vous acceptez leur utilisation.<br>En aucun cas les données utilisées pour se connecter, pour s'inscrire, pour naviguer sur le site internet n'est revendu à des tiers ou utilisées à des fins commerciales.<br>Le contenu du site ainsi que ses fonctionnalités sont protégés par des droits d'auteurs. Son utilisation et sa reproduction doit être strictement personnelle, et non commerciale. Pour toute question à ce propos, veuillez nous contacter via : <a class="link" href="mailto:contact@revision-medecine.fr">Conférence Démocrite</a>.</p>
			</div>
		</div>
		<div class="col d-flex align-items-center justify-content-center bg-dark text-white small w-100">
			<span class="small">Conférence Démocrite 2019 &copy; - contact@revision-medecine.fr - Tout droit réservé.</span>
		</div>

		<script>

			$("#plateformed").click(function(){
				$("input[name='user']").focus();
			})

			$("#sendcontact").click(function(){
				bad = false;
				
				if ($("input[name='nomcontact']").val().length == 0){ $("input[name='nomcontact']").addClass('btn-outline-danger'); bad = true; }
				else $("input[name='nomcontact']").removeClass('btn-outline-danger');
				
				if ($("input[name='prenomcontact']").val().length == 0){ $("input[name='prenomcontact']").addClass('btn-outline-danger'); bad = true; }
				else $("input[name='prenomcontact']").removeClass('btn-outline-danger');
				
				if ($("input[name='mailcontact']").val().length == 0){ $("input[name='mailcontact']").addClass('btn-outline-danger'); bad = true; }
				else $("input[name='mailcontact']").removeClass('btn-outline-danger');
				
				if ($("textarea[name='messagecontact']").val().length == 0){ $("textarea[name='messagecontact']").addClass('btn-outline-danger'); bad = true; }
				else $("textarea[name='messagecontact']").removeClass('btn-outline-danger');

				if ($("#sujetcontact").children("option:selected").html().length == 0){ $("#spansujet").addClass('text-danger').html('highlight_off'); bad = true; }
				else $("#spansujet").removeClass('text-danger').html('help');
				
				if (!bad){
					$("#sendcontact").attr('disabled', true);
					$("#spancontact").addClass("spinner-grow");
					var nom = $("input[name='nomcontact']").val();
					var prenom = $("input[name='prenomcontact']").val();
					var mail = $("input[name='mailcontact']").val();
					var sujet = $("#sujetcontact").children("option:selected").html();
					var message = $("textarea[name='messagecontact']").val();
					$.post(
						'functions.php',
						{action: 6,
							nom: nom,
							prenom: prenom,
							mail: mail,
							sujet: sujet,
							message: message},
						function(data){
							$("#sendcontact").html("Votre message a bien été envoyé.");
							$("#spancontact").removeClass("spinner-grow");
							$("input[name='nomcontact']").val('');
							$("input[name='prenomcontact']").val('');
							$("input[name='mailcontact']").val('');
							$("textarea[name='messagecontact']").val('');
						}
					);
				}
			})

			$("input[name='mail']").focus(function(){
				var user = ($("#prenom").val().charAt(0).toLowerCase() + $("#nom").val().toLowerCase()).replace(/[0-9]/g, "");
				$("input[name='login']").attr("value", user);
			});

			function testInput(event) {
				var value = String.fromCharCode(event.which);
				var pattern = new RegExp(/[a-zåäö]/i);
				return pattern.test(value);
			}

			$("#nom").bind('keypress', testInput);
			$("#prenom").bind('keypress', testInput);

			function signedin(){
				alert("Inscription effectuée avec succès, votre login : "+$("input[name='login']").val());
				$("#inscription").fadeOut();
				$("#inscription").addClass("sr-only");
				$("#connexion").removeClass("sr-only");
				$("#connexion").fadeIn();
				$("#spaninscrit").removeClass('spinner-grow');
				$("button[name='save']").html("Vous vous êtes déjà inscrit.");
				if (!$("span[name='erreurinscription']").hasClass('sr-only')) $("span[name='erreurinscription']").addClass('sr-only');
			}

			function inscription(){
				bad = false;

				if ($("#promo").children("option:selected").html().length == 0) {$("#spanpromo").addClass('text-danger'); $("#spanpromo").html('highlight_off'); bad=true;}
				else {$("#spanpromo").removeClass('text-danger'); $("#spanpromo").html('school');; }

				if ($("#ville").children("option:selected").html().length == 0) {$("#spanlocation").addClass('text-danger'); $("#spanlocation").html('highlight_off'); bad=true;}
				else {$("#spanlocation").removeClass('text-danger'); $("#spanlocation").html('my_location');}

				if ($("#nom").val().length == 0){ $("#nom").addClass("btn-outline-danger"); bad = true; }
				else { $("#nom").removeClass("btn-outline-danger"); bad = false; }

				if ($("#prenom").val().length == 0){ $("#prenom").addClass("btn-outline-danger"); bad = true; }
				else { $("#prenom").removeClass("btn-outline-danger"); bad = false; }
				
				if ($("input[name='mail']").val().length == 0){ $("input[name='mail']").addClass("btn-outline-danger"); bad = true; }
				else { $("input[name='mail']").removeClass("btn-outline-danger"); bad = false; }
				
				if ($("#password").val().length < 5){ $("#password").addClass("btn-outline-danger"); bad = true; }
				else { $("#password").removeClass("btn-outline-danger"); bad = false; }

				if (!bad){
					var inom = $("#nom").val();
					var iprenom = $("#prenom").val();
					var imail = $("input[name='mail']").val();
					var ipassword = $("#password").val();
					var iuser = $("input[name='login']").val();
					var ipromo = $("#promo").children("option:selected").html();
					var iville = $("#ville").children("option:selected").html();
					$("#spaninscrit").addClass('spinner-grow');
					$("button[name='save']").attr("disabled", true);
					$.post(
						'functions.php',
						{action: 2, 
							nom: inom, 
							prenom: iprenom, 
							mail: imail, 
							password: ipassword, 
							user: iuser,
							promo: ipromo,
							ville: iville},
						function(data){
							if (data == "-1"){
								$("#spaninscrit").removeClass('spinner-grow');
								$("button[name='save']").attr("disabled", false);
								$("span[name='erreurinscription']").removeClass("sr-only").html("Utilisateur déjà existant.");
							}
							else if (data == "1")
								signedin();
						},
						'text'
					);
				}
			}

			function connect(){
				$.post(
					'functions.php',
					{action: 1, login: $("input[name='user']").val(), password: $("input[name='password']").val()},
					function (data){
						if (data == "-1")
						{
							$("span[name='erreur']").removeClass("sr-only").html("L'utilisateur n'est pas enregistré.");
						}
						else if (data == "0"){
							$("span[name='erreur']").removeClass("sr-only").html("Mauvais mot de passe.");
						}
						else if (data == "1"){
							window.location = "/ecn/profil";
						}
						else if (data == "3"){
							alert("Admin");
						}
					}
				);
			}

			function connection(){
				bad = false;
				if ($("input[name='user']").val().length == 0)
				{
					$("input[name='user']").addClass("btn-outline-danger");
					bad = true;
				}
				else $("input[name='user']").removeClass("btn-outline-danger");
				if ($("input[name='password']").val().length == 0)
				{
					$("input[name='password']").addClass("btn-outline-danger");
					bad = true;
				}
				else $("input[name='user']").removeClass("btn-outline-danger");
				if (!bad){
					connect();
				}
			}

			$("#btninscrire").click(function(){
				if(!$("#contacter").hasClass("sr-only"))
					$("#contacter").fadeOut().addClass("sr-only");
				if (!$("#connexion").hasClass("sr-only"))
					$("#connexion").fadeOut().addClass("sr-only");
				$("#inscription").removeClass("sr-only").fadeIn();
			});

			$("#btnseconnecter").click(function(){
				if(!$("#contacter").hasClass("sr-only"))
					$("#contacter").fadeOut().addClass("sr-only");
				if (!$("#inscription").hasClass("sr-only"))
					$("#inscription").fadeOut().addClass("sr-only");
				$("#connexion").removeClass("sr-only").fadeIn();
			})

			$("#btncontacter").click(function(){
				if(!$("#connexion").hasClass("sr-only"))
					$("#connexion").fadeOut().addClass("sr-only");
				if (!$("#inscription").hasClass("sr-only"))
					$("#inscription").fadeOut().addClass("sr-only");
				$("#contacter").removeClass("sr-only").fadeIn();
			})


			$("textarea").keypress(function (e) {
				if (e.keyCode != 13) return;
				var msg = $("textarea").val().replace(/\n/g, "");
				return false;
			});

			$(document).keyup(function(e) {
				if(e.which == 13) {
					if ($("input[name='user']").is(":focus") || $("input[name='password']").is(":focus") || $("button[name='login']").is(":focus")){
						if (!$("#connexion").hasClass("sr-only"))
							connection();
						if (!$("#inscription").hasClass("sr-only"))
							inscription();
					}

				}
			});

			$("button[name='login']").click(function(){
				connection();
			});

			$("button[name='save']").click(function(){
				inscription();
			})
		</script>
	</body>
</html>