<?
	fputs(fopen("../bddusers/historique/".$_COOKIE['PACES-DEMOCRITE'], "a+"), "\nhttps://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
	<a class="navbar-brand d-flex align-items-center font-weight-bold text-white" href="#">
		<img src="https://revision-medecine.fr/paces/img/logo.png" width="70" height="70" class="d-inline-block align-top" alt="">D-Learning
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<div class="col d-flex justify-content-center">
			<ul class="navbar-nav text-white">
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center" href="index.php"><span class="material-icons mr-2">account_circle</span>Profil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center" href="suivicours.php"><span class="material-icons mr-2">school</span>Suivi des cours</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center" href="planchage.php"><span class="material-icons mr-2">assignment</span>Planchages</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center" href="cours.php"><span class="material-icons mr-2">find_in_page</span>Mes cours</a>
				</li>
			</ul>
		</div>
		<span class="navbar-text">
			<button id="deconnect" class="btn btn-danger material-icons">power_settings_new</button>
		</span>
	</div>
	<script>
		$("#deconnect").click(function(){
			$.post('functions.php',{action: 3}, function (data){window.location = '/paces/index'}, 'text');
		})
	</script>
</nav>