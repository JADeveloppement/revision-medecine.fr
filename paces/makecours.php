<html>
	<head>
		<title>Démocrite - Aperçu <?echo $_GET['titre'];?></title>
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

		<div class="container-fluid mt-4 mb-4">
			<ul class="list-group container-fluid w-100 mb-4" style="border-style: solid !important; border-width: 2px !important; border-color: black !important;">
				<li class="list-group-item list-group-item-light font-weight-bold"><?echo $_GET['titre'];?></li>
				<li class="list-group-item list-group-item-warning">Ceci n'est qu'un aperçu du cours, une partie du polycopié est disponible à la lecture</li>
			</ul>
				<iframe style="margin-top: -8%;" src="https://drive.google.com/file/d/<?echo $_GET['value'];?>/preview" width="100%" height="100%"></iframe>
		</div>

		<?include_once "footer.php";?>
	</body>
</html>