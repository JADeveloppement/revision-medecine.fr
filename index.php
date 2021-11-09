<html>
	<head>
		<title>Révisions Médecine</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.75">
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
		
		<!-- ICONES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body class="bg-success">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<div class="col h-100 d-flex align-items-center justify-content-center">
			<div class="col">
				<div class="col d-flex align-items-center justify-content-center">
					<h2 class="text-white mb-5">Vous préparez :</h2>
				</div>
				<div class="row">
					<div class="col mb-2 d-flex align-items-center justify-content-center">
						<button class="btn btn-light p-5" id="paces">
							<div class="col text-center">
								<h3 class="card-title material-icons" style="font-size: 4rem;"><img src="https://img.icons8.com/ios/50/000000/doctors-bag.png"></h3>
								<h3 class="card-title">La PACES</h3>
							</div>
						</button>
					</div>

					<div class="col mb-2 d-flex align-items-center justify-content-center" id="coeur">
						<div class="col-md-auto d-flex align-items-center justify-content-center" style="border-style: solid; border-width: 1px; border-color: white; border-radius: 10px;">
							<img id="img" src="/paces/img/logo.png">
						</div>
					</div>
					<script>
						if ($(window).width() < 557)
							$("#coeur").addClass("sr-only");
						else $("#coeur").removeClass("sr-only");

						function pulse(back) {
							//$('#img img').animate({width: (back) ? $('#img').width() + 20 : $('#img').width() - 20}, 700);
							$('#img').animate({opacity: (back) ? 1 : 0.2}, 500, function(){pulse(!back)});
						}

						pulse(false);
					</script>

					<div class="col mb-2 d-flex align-items-center justify-content-center">
						<button class="btn btn-light p-5">
							<div class="col text-center" id="ecn">
								<h3 class="card-title material-icons" style="font-size: 4rem;"><img src="https://img.icons8.com/ios/50/000000/caduceus.png"></h3>
								<h3 class="card-title">Les ECN</h3>
							</div>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col d-flex align-items-center justify-content-center bg-dark text-white text-center small w-100" style="position: fixed; bottom:0px;">
			<span class="small">Conférence Démocrite 2019 &copy; - contact@revision-medecine.fr - Tous droits réservés</span>
		</div>
		<script>
			$("#paces").click(function(){
				window.location = "/paces/";
			});

			$("#ecn").click(function(){
				window.location = "/ecn/";
			});
		</script>
	</body>
</html>