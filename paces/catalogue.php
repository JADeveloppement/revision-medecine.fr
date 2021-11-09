<?

	include_once "config.php";

?>
<html>
	<head>
		<title>D-Learning - Catalogue</title>
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


		<!--  PAYPAL  -->
		<script  src="https://www.paypal.com/sdk/js?client-id=AXvKMfvS4lAIuop8bSUYw7CF4KudlwvRuO_-av5RyD_pLpAimO4xnjy_lVlmvxuanMvHaLYMfZQV3uPv&currency=EUR"></script>
		<!-- <script  src="https://www.paypal.com/sdk/js?client-id=AQpk_wnJIkBChrUr9IjdNd0ukcq82VBaxaoup_fPXaYXHuO_LZTzrr8k6XbtXhEbmlDbfmQd3K_b7n-F&currency=EUR"></script>-->

		<div id="toast" class="toast" style="z-index: 100; position: fixed; bottom: 0; right: 0; width: 18rem;" role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-delay="1500" data-autohide="true">
			<div class="toast-header">
				<svg class="bd-placeholder-img rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#28a745"></rect></svg>
				<strong class="mr-auto">Démocrite</strong>
				<small class="text-muted">A l'instant</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				Ajouté au panier !
			</div>
		</div>

		<div class="container-fluid mt-4 mb-4" id="etape1">
			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item bg-success text-white h5">Informations</li>
					<li class="list-group-item">Sur cette page, vous pouvez commander les supports demandés imprimés sous format de livret A5 (fiches, QCMs, outil) ou A4 (cours, schémas) au choix : <br><br>
						<p class="ml-4">A récupérer à un point de retrait (adresse communiquée par mail) où un tuteur vous distribuera la commande (<b>munissez vous de votre facture</b>)</p>
						<p class="ml-4">Par envoie postal à votre adresse où les frais de livraison s'élèvent à 7€.</p></li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">Outils de travail</li>
					<li class="list-group-item"><span name="produit" indice="">Cahier de suivi des révisions</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Outil</button>
							<button class="btn btn-warning mr-3" name="pages">30 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1zAkFNJOvwKNmdCXNyTVIYBfDCXtNGQcN" titre="Suivi de révisions">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[0];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE1 - Chimie générale, chimie organique, acide aminé, enzyomologie, protéine</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Chimie général</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">72 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1HaWjpfV6c6LKLSHTOQDMrURzTqxpvT0H" titre="UE1 - Chimie général">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[1];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Chimie général</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Fiches</button>
							<button class="btn btn-warning mr-3" name="pages">59 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1a_36sbH9-kp-9lfpm-c39i4WIUBJUWpa" titre="UE1 - Chimie général">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[2];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Chimie organique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">64 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1XzuqRFtezSj55igvfGk52tiYphxebPWQ" titre="UE1 - Chimie organique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[3];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Chimie organique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Fiches</button>
							<button class="btn btn-warning mr-3" name="pages">40 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1LaRaDX7JF0tQqx1UzGl1eseVkn-v6aR_" titre="UE1 - Chimie organique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[4];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Acides aminés, protéines, enzymes</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">71 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1ADfu_CzKEevNcNriT9gwzN-qvsKONWqm" titre="UE1 - Acides aminés, protéines, enzymes">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[5];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Métabolisme énergétique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">32 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1PKjEXF6emHICPePVsf9RZVbflU-ciclQ" titre="UE1 - Métabolisme énergétique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[6];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE1 - Glucides, lipides</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">72 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1UNkyTcnlQXrP6-yk6KKCIvHVqO68DINR" titre="UE1 - Glucides, lipides">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[7];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE1 - Chimie générale, organique, enzymologie, biologie moléculaire</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCM</button>
							<button class="btn btn-warning mr-3" name="pages">133 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[8];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE2 - Biologie cellulaire, histologie, embryologie</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Biologie cellulaire</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">149 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1C5eriEPZ9DIcPEmutfONfBnPF1kjdcAT" titre="UE2 - Biologie cellulaire">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[9];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Histologie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">42 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1c8Ihyw2Fxststa9IT2Hp6EN8WdiGCCmK" titre="UE2 - Histologie">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[10];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Embryologie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">103 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1xABQeNyggmjlsk35QCXHGhwkXn7ugouD" titre="UE2 - Embryologie">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[11];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Biologie cellulaire</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">109 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[12];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Histologie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">83 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[13];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE2 - Embryologie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">49 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[14];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE3A - Thermodynamique, électricité, magnétisme</li>
					<li class="list-group-item"><span name="produit" indice="">UE3A - Thermodynamique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">48 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1ilnR8PltheFYKCu10NfrLJ_OSnnJo5jR" titre="UE3A - Thermodynamique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[15];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE3A - Electricité magnétisme</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">90 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1C1_fM06bVcfAYPdzr2VSVPGgG4y6rvJ-" titre="UE3A - Electricité magnétisme">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[16];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE3A - Thermodynamique, électricité magnétisme, optique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">99 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[17];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE4 - Grandeurs et mesures, probabilités, statistiques</li>
					<li class="list-group-item"><span name="produit" indice="">UE4 - Formulaire Grandeurs et mesures, probabilités, statistiques</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Fiches</button>
							<button class="btn btn-warning mr-3" name="pages">56 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1h1hrDKUThOrpxspEEU9mHdjPEum-uxq8" titre="UE4 - Formulaire Grandeurs et mesures, probabilités, statistiques">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[18];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE4 - Grandeurs et mesures, probabilités, statistiques</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">99 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[19];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE3B - Mécanique des fluides, équilibre acido-basique, transports membranaire</li>
					<li class="list-group-item"><span name="produit" indice="">UE3B - Mécanique des fluides</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">31 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1GUU4G5INa-aJNmf4t8pUROOAmIRPhdF4" titre="UE3B - Mécanique des fluides">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[20];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE3B - Equilibre acidobasique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">48 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1tTZeFsWOINVXFodBrRWSdoL1seLk1PE0" titre="UE3B - Equilibre acidobasique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[21];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE3B - Transports membranaires</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">51 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1acNVTUiokv1vaH3NMA-3FNxLtMbLsF7d" titre="UE3B - Transports membranaires">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[22];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE3B - Mécanique des fluides, Equilibre acidobasique, Transports membranaires, Radioactivité</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">45 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[23];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE5 - Anatomie</li>
					<li class="list-group-item"><span name="produit" indice="">UE5 - Généralités, appareil cardiocirculatoire, tête et cou</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">59 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1Lp581IMn-ACY4FcEwd1nDHAixIGJHvWf" titre="UE5 - Généralités, appareil cardiocirculatoire, tête et cou">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[24];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE5 - Membre supérieur, inférieur, appareil respiratoire, système nerveux central</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">66 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1PaShjqQBXoSo3Cb6ADuLgrJqrnCCpKdY" titre="UE5 - Membre supérieur, inférieur, appareil respiratoire, système nerveux central">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[25];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE5 - Os/articulations/muscles, Parois du tronc, appareil urogénital</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">35 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1a8KPvUBHee-uFNi7LwQ5zyka-E6W8qyI" titre="UE5 - Os/articulations/muscles, Parois du tronc, appareil urogénital">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[26];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE5 - Schémas</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Schémas</button>
							<button class="btn btn-warning mr-3" name="pages">35 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1EIqK0pzkqXn_rIPoxAmw-RBKaTTs8veP" titre="UE5 - Schémas">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[27];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE5 - Anatomie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">186 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[28];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE6 - Pharmacologie</li>
					<li class="list-group-item"><span name="produit" indice="">UE6 - Connaissance du médicament</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">26 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1NnotLhR3IIkM6PRyHwk6csdVxxcbOjb_" titre="UE6 - Connaissance du médicament">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[29];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE6 - Droit du médicament</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">18 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1hdC0QT7jWboe-bvApjLJ5sqLV6w9pj8M" titre="UE6 - Droit du médicament">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[30];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE6 - Développement du médicament</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">38 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1nD15ZsLXKubc2f3ehbzhyUNiKiKt8am0" titre="UE6 - Développement du médicament">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[31];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE6 - Pharmacocinétique</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">44 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="14kUeNvi3eIrv7B4NM0knPcLnh1X_3uwq" titre="UE6 - Pharmacocinétique">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[32];?> €</button>
						</span>
					</li>
					<li class="list-group-item"><span name="produit" indice="">UE6 - Pharmacodynamie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">68 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1OL0lH4gi-8IoEQfn9oKXNAwwWOu2Iuo3" titre="UE6 - Pharmacodynamie">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[33];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE6 - Pharmacologie</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">QCMs</button>
							<button class="btn btn-warning mr-3" name="pages">90 pages</button>
							<button class="btn btn-light mr-3" disabled>Aperçu</button>
							<button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[34];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group mb-3">
					<li class="list-group-item bg-success text-white h5">UE7 - Santé, société, humanité</li>
					<li class="list-group-item"><span name="produit" indice="">UE7 - Mal être/être malade, la maladie, Fondements de la médecine, Evidence Based Medicine</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">91 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1nMs1siWW8TWfaKL33zaxl8mvtw59AqnJ" titre="UE7 - Mal être/être malade, la maladie, Fondements de la médecine, Evidence Based Medicine">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[35];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE7 - Thérapies complémentaires</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">15 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1eBCEzUM-GAApLvQVzj8auSYjtGuV8nkB" titre="UE7 - Thérapies complémentaires">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[36];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE7 - Interruption volontaire de grossesse, Déni de grossesse, Assistance Médicale à la procréation</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">31 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1_4LNNNNT1fr7Scq0n__GN1Us-3_Seo4V" titre="UE7 - Interruption volontaire de grossesse, Déni de grossesse, Assistance Médicale à la procréation">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[37];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE7 - Mémoire autobiographie, neurosciences cognitives</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">49 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1pTx-JpAObnfgaVNEDW65gYb3_xwNmKe0" titre="UE7 - Mémoire autobiographie, neurosciences cognitives">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[38];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE7 - Développement cognitif précoce</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">22 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1UK5vRG5NSJfpgxh3d3a1zFOyw_KrTdFq" titre="UE7 - Développement cognitif précoce">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[39];?> €</button>
						</span>
					</li>

					<li class="list-group-item"><span name="produit" indice="">UE7 - Violences individuelles, collectives et groupales</span>
						<span class="float-right">
							<button class="btn btn-warning mr-3">Cours</button>
							<button class="btn btn-warning mr-3" name="pages">14 pages</button>
							<button class="btn btn-light mr-3" name="apercu" url="1STy1TNz-_TiSO2N87Bw5qduOcqiXpgOg" titre="UE7 - Violences individuelles, collectives et groupales">Aperçu</button><button class="btn btn-success mr-3" name="achat" id="" indice=""><?echo $prix[40];?> €</button>
						</span>
					</li>
				</ul>
			</div>

			<div class="col mb-4">
				<ul class="list-group">
					<li class="list-group-item bg-success text-white h5">Votre panier</li>
					<li class="list-group-item">
						<div class="col" id="produit">
							
						</div>
					</li>
					<li class="list-group-item list-group-item-success" id="totalpanier">Total : 0 €</li>
					<li class="list-group-item"><span><button class="btn btn-warning" name="payerpanier">Valider le panier</button></li>
				</ul>
			</div>
		</div>

		<div class="container-fluid mt-4 mb-4 sr-only" id="etape2">
			<ul class="list-group mb-3">
				<li class="list-group-item bg-success text-white font-weight-bold centre">Etape 2 : Inscription</li>
			</ul>
			<ul class="list-group mb-3">
				<li class="list-group-item">Ces informations sont importantes soit pour l'envoi ou le retrait ainsi que la réception de la facture de votre commande.</li>
			</ul>
			<ul class="list-group mb-2">
				<li class="list-group-item">
					<div class="row">
						<div class="col"><input class="form-control" name="nom" type="text" placeholder="Nom"></div>
						<div class="col"><input class="form-control" name="prenom" type="text" placeholder="Prénom"></div>
						<div class="col"><input class="form-control" name="ddn" type="text" placeholder="Date de Naissance (JJ/MM/AAAA)"></div>
					</div>
				</li>
				<li class="list-group-item">
					<input class="form-control" type="text" name="adresse" placeholder="Votre adresse">
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col"><input class="form-control" name="codepostale" type="text" placeholder="Code postale"></div>
						<div class="col"><input class="form-control" name="ville" type="text" placeholder="Ville"></div>
						<div class="col"><input class="form-control" name="email" type="text" placeholder="E-mail"></div>
						<div class="col"><input class="form-control" name="telephone" type="text" placeholder="Téléphone"></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="retrait">
								<label class="form-check-label" for="retrait">Retrait en imprimerie</label>
							</div>
						</div>
						<div class="col">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="envoi">
								<label class="form-check-label" for="envoi">Envoi postal (7€ de frais de port)</label>
							</div>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="col" id="recap">
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="CGV">
						<label class="form-check-label" for="CGV">En cochant cette case, vous acceptez les <a href="CGVsupport.pdf" target="_blank">Conditions générales de vente de supports Démocrite</a>.</label>
					</div>
				</li>
				<li class="list-group-item">
					<button class="btn btn-success mr-3" name="continuerpaiement">Procéder au paiement</button><button class="btn btn-danger" name="annuler">Annuler</button>
				</li>
			</ul>
			<hr>
			<p class="small text-muted">En aucun cas les informations communiquées lors de la commande ne sont retransmises à des tiers, partiellement ou entièrement. Leur seule utilisation est interne à nos services (pour la rédaction des factures, leur envoi, ...) pour des raisons administratives ou statistiques (adresse IP). Les informations récoltées et leur utilisation par Paypal, Googne Analytics, Bootstrap, Material-icons, sont disponibles sur leur site internet respectifs.</p>
		</div>		

		<script>
			var prix_cata = [<?foreach($prix as $i) echo "$i,"; echo "0"?>], totalpanier = 0, produit = [], prix_prod = [];
			$("button[name='payerpanier']").attr("disabled", true);
			$("#produit").append("<li class='list-group-item list-group-item-danger' id='aucun'>Aucun article dans votre panier.</li>");

			function prixpanier(){
				$('#totalpanier').html("Total : "+totalpanier+" €");
			}

			$("button[name='apercu']").click(function(){
				window.open("makecours.php?titre="+$(this).attr('titre')+"&value="+$(this).attr('url'), "_blank");

			})

			$("button[name='continuerpaiement']").click(function(){
				bad = false;

				if (!$("#CGV").is(":checked")){
					bad = true;
					$("label[for='CGV']").addClass('text-danger');
				} else $("label[for='CGV']").removeClass('text-danger');

				if ($("input[name='nom']").val().length == 0){
					$("input[name='nom']").addClass("border-danger");
					bad = true;
				} else $("input[name='nom']").removeClass("border-danger");

				if ($("input[name='prenom']").val().length == 0){
					$("input[name='prenom']").addClass("border-danger");
					bad = true;
				} else $("input[name='prenom']").removeClass("border-danger");

				if ($("input[name='ddn']").val().length == 0){
					$("input[name='ddn']").addClass("border-danger");
					bad = true;
				} else $("input[name='ddn']").removeClass("border-danger");

				if ($("input[name='adresse']").val().length == 0){
					$("input[name='adresse']").addClass("border-danger");
					bad = true;
				} else $("input[name='adresse']").removeClass("border-danger");

				if ($("input[name='codepostale']").val().length == 0){
					$("input[name='codepostale']").addClass("border-danger");
					bad = true;
				} else $("input[name='codepostale']").removeClass("border-danger");

				if ($("input[name='ville']").val().length == 0){
					$("input[name='ville']").addClass("border-danger");
					bad = true;
				} else $("input[name='ville']").removeClass("border-danger");

				if ($("input[name='email']").val().length == 0){
					$("input[name='email']").addClass("border-danger");
					bad = true;
				} else $("input[name='email']").removeClass("border-danger");

				if ($("input[name='telephone']").val().length == 0){
					$("input[name='telephone']").addClass("border-danger");
					bad = true;
				} else $("input[name='telephone']").removeClass("border-danger");

				if (!$("#retrait").is(":checked") && !$("#envoi").is(":checked")){
					bad = true;
					$("label[for='envoi']").addClass("text-danger");
					$("label[for='retrait']").addClass("text-danger");
				} else {
					$("label[for='envoi']").removeClass("text-danger");
					$("label[for='retrait']").removeClass("text-danger");
				}

				if (!bad){
					var nom = $("input[name='nom']").val(), prenom = $("input[name='prenom']").val(), ddn = $("input[name='ddn']").val(), adresse = $("input[name='adresse']").val(), ville = $("input[name='ville']").val(), codepostale = $("input[name='codepostale']").val(), telephone = $("input[name='telephone']").val(), email = $("input[name='email']").val(), line1 = produit.join("2019paces"), line2 = prix_prod.join("2019paces"), line3 = nom+"2019paces"+prenom+"2019paces"+ddn+"2019paces"+adresse+"2019paces"+codepostale+"2019paces"+ville+"2019paces"+telephone+"2019paces"+email, id = $.now();
					if ($("#retrait").is(":checked")) line4 = 0;
					else if($("#envoi").is(":checked")) line4 = 1;
					$.post(
						'config.php',
						{action: 1, id: id, line1: line1, line2: line2, line3: line3, line4: line4},
						function (data){
							window.open("paiement.php?token="+id, "_blank");
						}, 'text'
					);
				}
			})

			$("button[name='annuler']").click(function(){
				$("#recap").empty();
				$("#etape2").fadeOut();
				$("#etape1").fadeIn();
				produit = [];
				prix_prod = [];
			})
			
			$("button[name='payerpanier']").click(function(){
				var i = 0;
				$("#produit").children().each(function(){
					indice = parseInt($(this).attr("name").replace("panier", ""));
					produit[i] = $("span[indice='"+indice+"']").html();
					prix_prod[i] = prix_cata[indice];
					i++;
				})
				$("#etape1").fadeOut();
				$("#etape2").removeClass("sr-only").fadeIn();
				for (i = 0; i < produit.length; i++)
					$("#recap").append("<div class='col mb-3 mt-3'>"+produit[i]+"<span class='float-right'><button class='btn btn-success'>"+prix_prod[i]+" €</button></span></div>");
				$("#recap").append("<div class='col mb-3 mt-3 font-weight-bold'>Total : "+totalpanier+"€</div>");
			})

			$("#modalachat").on("hide.bs.modal", function(e){
				$("#achatcourstitre").html("Sélectionnez un cours à visualiser.");
				$("#contenupanier").empty();
				$("#achatprix").html("Sélectionnez un article.");
			})

			$("button[name='achat']").click(function(){
				$("#toast").toast('show');
				indice = $(this).attr("indice");
				titre = $("span[indice='"+indice+"']").html();
				totalpanier += prix_cata[indice];
				$(this).attr("disabled", "true");
				$("#produit").append("<div class='col mb-3 mt-3' name='panier"+indice+"'>"+titre+"<span class='float-right'><button class='btn btn-success'>"+$(this).html()+"</button><button class='btn btn-danger ml-2 retirer' indice='"+indice+"'>Retirer</button></span></div>");
				prixpanier();
				$("#aucun").remove();
				$("button[name='payerpanier']").removeAttr("disabled");
			})

			$("#produit").on("click", ".retirer", function(){
				indice = parseInt($(this).attr("indice"));
				$("div[name='panier"+indice+"']").remove();
				totalpanier -= prix_cata[indice];
				prixpanier();
				if ($("#produit > div").length == 0){
					$("#produit").append("<li class='list-group-item list-group-item-danger' id='aucun'>Aucun article dans votre panier.</li>");
					$("button[name='payerpanier']").attr("disabled", true);
				}
				$("#achat"+indice).removeAttr("disabled");

			})

			var a = 0;
			$("span[name='produit']").each(function(){
				$(this).attr("indice", a);
				a++;
			});
			var a = 0;
			$("button[name='achat']").each(function(){
				$(this).attr("indice", a);
				$(this).attr("id", "achat"+a);
				a++;
			});
		</script>

		<script>
			/*if (/Mobi|Android/i.test(navigator.userAgent)) {
			    //alert("La navigation sur téléphone portable n'est pas optimisée. Consultez notre site internet sur un ordinateur pour une meilleure expérience d'utilisation.");
			    $("#desktop").empty();
			}
			else {
				$("#mobile").empty();
			}*/
		</script>

		<?include_once "footer.php";?>
	</body>
</html>