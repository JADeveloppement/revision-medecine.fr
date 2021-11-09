<div class="modal fade" id="modalcontact" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nous contacter</h5>
			</div>
			<div class="modal-body">
				<div class="col">
					<div class="row">
						<div class="col"><input class="form-control mb-2" id="nomcontact" value="<?echo $line2[0];?>" readonly></div>
						<div class="col"><input class="form-control mb-2" id="prenomcontact" value="<?echo $line2[1];?>" readonly></div>
					</div>
					<input class="form-control mb-2" id="mailcontact" value="<?echo $line2[4];?>" readonly>
					<select class="form-control mb-2" id="sujetcontact">
						<option selected>Problème sur le site</option>
						<option>Problème pour mettre à niveau</option>
						<option>Suggestion d'amélioration</option>
						<option>Autre</option>
					</select>
					<textarea class="form-control mb-2" id="messagecontact"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary d-flex align-items-center justify-content-center" id="sendcontact"><span id='spancontact'></span>Envoyer</button>
				<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
	<a class="navbar-brand">Bienvenue <?echo $identite; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
			<!--<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Features</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>-->
		</ul>
		<span class="navbar-text">
			<button class="btn btn-light material-icons" data-toggle="modal" data-target="#modalcontact">mail</button>
			<?
				if ($essai){
					if ($expired)
						echo "<button class='btn btn-danger'>Essai expiré.</button>";
					else
						echo "<button class='btn btn-warning'>Essai gratuit : ".($jouressai - $periode)." jours restants.</button>";
				}
				else
					echo "<button class='btn btn-success'>Accès illimité.</button>";
			?>
			<button onclick="window.location = '/ecn/?act=deconnection'" class="btn btn-danger"><span class='material-icons'>power_settings_new</span></btn>
		</span>
	</div>
</nav>
<style>
	.align-center{
		display: flex;
		align-items: center;
		justify-content: center;
	}
</style>
<div class="col-md-12">
	<ul class="nav nav-tabs nav-fill">
		<li class="nav-item"><a class="align-center nav-link <?if (strpos($_SERVER['REQUEST_URI'], "profil") !== false) echo "active";?>" href="/ecn/profil"><span class="material-icons mr-3">account_circle</span>Profil</a>
		<li class="nav-item"><a class="align-center nav-link <?if (strpos($_SERVER['REQUEST_URI'], "relecture") !== false) echo "active";?>" href="/ecn/relecture"><span class="material-icons mr-3">chrome_reader_mode</span>Relecture</a>
		</li>
		<li class="nav-item"><a class="align-center nav-link <?if (strpos($_SERVER['REQUEST_URI'], "fiches") !== false) echo "active";?>" href="/ecn/fiches"><span class="material-icons mr-3">description</span>Fichés</a>
		</li>
		<li class="nav-item"><a class="align-center nav-link <?if (strpos($_SERVER['REQUEST_URI'], "listeitems") !== false) echo "active";?>" href="/ecn/listeitems"><span class="material-icons mr-3">find_in_page</span>Suivi détaillé</a>
		</li>
	</ul>
</div>