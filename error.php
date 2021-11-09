<?php
	
	$error = intval($_GET['error']);
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

		<header class="navbar navbar-expand navbar-dark bg-success flex-column flex-md-row bd-navbar">
			<nav class="navbar navbar-expand-lg navbar-dark text-white">
				<h2 class="navbar-brand mr-2" style="font-size: 1.8rem;">Démocrite 
				</h2>
				<div class="navbar-nav-scroll">
					<ul class="navbar-nav bd-navbar-nav flex-row">
						
					</ul>
				</div>
			</nav>
		</header>

		<div class="col">
			<div class="row d-flex align-items-center justify-content-center h-100" style="background-image: url('/ecn/img/logo.jpg');">
				<div class="card shadow mt-4 mb-4 border-success" style="max-width: 65%;">
					<div class="card-body text-center">
						<h5 class="card-title">Erreur de page</h5>
						<div class="card-text">
							<p><? if ($error == 404){ ?>Oupsi, la page que vous essayer de joindre n'existe pas. Avez-vous bien vérifier l'adresse web que vous avez tapé ?<?} else if ($error == 500){ ?>Les serveurs sont saturés. Veuillez réessayer dans un instant, nous faisons notre possible pour régler le problème.<? } ?>
						</div>
						<a class="card-link btn btn-success text-white mt-3 mb-3" href="/ecn/">Vous préparez les ECN</a>
						<a class="card-link btn btn-success text-white mt-3 mb-3" href="/paces/">Vous préparez la PACES</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col d-flex align-items-center justify-content-center bg-dark text-white small w-100">
			<span class="small">Conférence Démocrite 2019 &copy; - contact@revision-medecine.fr - Tout droit réservé.</span>
		</div>
	</body>
</html>