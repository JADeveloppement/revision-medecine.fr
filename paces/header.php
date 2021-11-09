<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<div class="modal fade" id="modalconnexion" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Plateforme D-learning</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="col">
					<div class="col"><input id="login" class="form-control mb-3 mt-3" type="text" placeholder="Nom d'utilisateur"></div>
					<div class="col"><input id="password" class="form-control mb-3" type="password" placeholder="Mot de passe"></div>
					<div class="col d-flex align-items-center mb-2"><button id="seconnecter" class="btn btn-success">Se connecter</button></div>
					<div class="col d-flex align-items-center mb-2"><span id="erreur" class="text-danger"></span></div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#seconnecter").click(function(){
		bad = false;
		if ($("#login").val().length == 0){
			$("#login").addClass("btn-outline-danger");
			bad = true;
		} else $("#login").removeClass("btn-outline-danger");

		if ($("#password").val().length == 0){
			$("#password").addClass("btn-outline-danger");
			bad = true;
		} else $("#password").removeClass("btn-outline-danger");

		if (!bad){
			$.post(
				'functions.php',
				{action: 2, login: $("#login").val(), password: $("#password").val()},
				function (data){
					if (parseInt(data) == -1)
						$("#erreur").html("Utilisateur non inscrit.");
					else if(parseInt(data) == -2)
						$("#erreur").html("Mauvais mot de passe.");
					else window.location = "plateforme/";
				}
			);
		}
	});
</script>

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
					<a class="nav-link d-flex align-items-center" href="index.php"><span class="material-icons mr-2">home</span>Accueil</a>
				</li>
				<li class="nav-item">
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
				</li>
			</ul>
		</div>
		<span class="navbar-text">
			<button class="btn btn-light" data-toggle="modal" data-target="#modalconnexion">Plateforme D-Learning</button>
		</span>
	</div>
</nav>