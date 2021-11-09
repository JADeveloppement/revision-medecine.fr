<?

	$id = $_GET['token'];
	$f = fopen($id, "r");
	$line1 = explode("2019paces", trim(fgets($f))); $line2 = explode("2019paces", trim(fgets($f))); $line3 = explode("2019paces", trim(fgets($f))); $line4 = trim(fgets($f));

	$total = 0;

	if (intval($line4) == 1) $envoi = true;
	else $envoi = false;

	foreach($line2 as $a)
		$total += intval($a);

	$totalttc = $total;
	if ($envoi) $totalttc += 7;

?>
<html>
	<head>
		<title>D-Learning - Paiement</title>
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

		<div class="container-fluid mt-4 mb-4">
			<ul class="list-group">
				<li class="list-group-item bg-success text-white font-weight-bold">Récapitulatif de votre commande</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col"><b>Nom : </b><?echo $line3[0];?></div>
						<div class="col"><b>Prénom : </b><?echo $line3[1];?></div>
						<div class="col"><b>Date de Naissance : </b><?echo $line3[2];?></div>
						<div class="col"><b>E-mail : </b><?echo $line3[7];?></div>
					</div>
				</li>
				<li class="list-group-item"><b>Adresse : </b><?echo $line3[3];?></li>
				<li class="list-group-item">
					<div class="row">
						<div class="col"><b>Code Postale :</b> <?echo $line3[4];?></div>
						<div class="col"><b>Ville : </b><?echo $line3[5];?></div>
						<div class="col"><b>Téléphone : </b><?echo $line3[6];?></div>
					</div>
				</li>
				<li class="list-group-item bg-success text-white font-weight-bold">Votre commande : </li>
				<li class="list-group-item">
					<div class="col">
						<?
						for ($a = 0; $a < count($line1); $a++)
							echo "<div class='col mt-3 mb-3'>".$line1[$a]."<span class='float-right'><button class='btn btn-primary'>".$line2[$a]." €</button></span></div>";
						?>
						<hr>
						<div class="col mt-3 mb-3" style="text-align: right;">Total panier : <?echo $total;?> €</div>
						<div class="col mt-3 mb-3" style="text-align: right;">Frais de livraison : <?if ($envoi) echo "7 €"; else echo "0 €";?></div>
						<hr>
						<div class="col mt-3 mb-3" style="text-align: right;"><b>Total TTC : <?echo $totalttc; ?> €</b></div>
					</div>
				</li>
				<li class="list-group-item list-group-item-warning">
					<div class="col">Veuillez bien vérifier l'exactitude des informations ci dessus, ils vous seront redemandés en cas de retrait. Si une erreur a lieu lors de la saisie, veuillez retourner dans la fenêtre précédente et modifier les informations erronnées.</div>
					<div class="col centre"><button class="btn btn-danger" id="annuler">Annuler la saisie</button></div>
				</li>
				<li class="list-group-item centre">
					<span id="btnpaypal"></span>
				</li>
			</ul>
		</div>

		<script>
			$("#annuler").click(function(){
				$.post('config.php', {action: 3, id: "<?echo $_GET['token'];?>"}, function (data){window.top.close();}, 'text');
			})

			paypal.Buttons({
				createOrder: function(data, actions){
					return actions.order.create({
						purchase_units: [{
							amount: { value: <?echo $totalttc; ?>+'.00'}
						}]
					});
				}, 
				onApprove: function(data, actions) {
					return actions.order.capture().then(function(details) {
						$.post(
							'config.php',
							{action: 2, token: "<?echo $_GET['token']; ?>"},
							function(data){
								alert("Paiement effectué, merci pour votre achat. Vous recevrez la facture récapitulative dans les quelques heures qui suivent. Merci pour votre confiance.");
								window.top.close();
							}
						);
					});
				}
			}).render('#btnpaypal')

		</script>

		<?include_once "footer.php";?>
	</body>
</html>