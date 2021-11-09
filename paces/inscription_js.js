var total = 0, total1 = 0, total2 = 0, total3 = 0, suivicours = 0, suiviplanchage = 0, cours = 0, optionsuivi = "aucun", optionplanchage = "aucun", optioncours = "aucun";
$("#total").html("Total : 0€");

$("#tel").keypress(function(e){
	if ($("#tel").val().length >= 12)
		return false;

	var x = e.which || e.keycode;
	if ((x>=48 && x<=57) || x==8 || (x>=35 && x<=40) || x==46)
		return true;
	else return false;
});

$("#codepostale").keypress(function(e){
	if ($(this).val().length >= 6)
		return false;

	var x = e.which || e.keycode;
	if ((x>=48 && x<=57) || x==8 || (x>=35 && x<=40) || x==46)
		return true;
	else return false;
});

function verification(){
	$("#nom").val($("#nom").val().replace(/ /g, "").replace(/é|è|ê|ë/g, "e").replace(/â|ä|à/g, "a").replace(/î|ï|ì/g, "i").replace(/ô|ö|ò/g, "o").replace(/û|ü|ù/g, "u").replace(/1|2|3|4|5|6|7|8|9|0/g, ""));
	$("#prenom").val($("#prenom").val().replace(/ /g, "").replace(/é|è|ê|ë/g, "e").replace(/â|ä|à/g, "a").replace(/î|ï|ì/g, "i").replace(/ô|ö|ò/g, "o").replace(/û|ü|ù/g, "u").replace(/1|2|3|4|5|6|7|8|9|0/g, ""));
	$("#mail").val($("#mail").val().replace(/ /g, "").replace(/é|è|ê|ë/g, "e").replace(/â|ä|à/g, "a").replace(/î|ï|ì/g, "i").replace(/ô|ö|ò/g, "o").replace(/û|ü|ù/g, "u"));
	
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

	if ($("#ddn").val().length == 0){
		$("#ddn").addClass("border-danger");
		bad = true;
	} else $("#ddn").removeClass("border-danger");

	if ($("#adresse").val().length == 0){
		$("#adresse").addClass("border-danger");
		bad = true;
	} else $("#adresse").removeClass("border-danger");

	if ($("#codepostale").val().length == 0){
		$("#codepostale").addClass("border-danger");
		bad = true;
	} else $("#codepostale").removeClass("border-danger");

	if ($("#ville").val().length == 0){
		$("#ville").addClass("border-danger");
		bad = true;
	} else $("#ville").removeClass("border-danger");

	if ($("#tel").val().length < 10){
		$("#tel").addClass("border-danger");
		bad = true;
	} else $("#tel").removeClass("border-danger");

	if ($("#bacserie").val().length == 0){
		$("#bacserie").addClass("border-danger");
		bad = true;
	} else $("#bacserie").removeClass("border-danger");

	if ($("#passwordinscription").val().length == 0){
		$("#passwordinscription").addClass("border-danger");
		bad = true;
	} else $("#passwordinscription").removeClass("border-danger");
	return bad;
}

function trouver (tab, val){
	var a = 0, b = tab.length, trouve = false;
	while (!trouve && a < b){
		if (tab[a] == val)
			trouve = true;
		a++;
	}
	return trouve;
}

function makeprix(){
	total = 0, total1 = 0, total2 = 0, total3 = 0, suivicours = 0, suiviplanchage = 0, cours = 0, optionsuivi = "aucun", optionplanchage = "aucun", optioncours = "aucun";
	var tab = [];
	$("select[name='choix']").children("option:selected").each(function(){
		tab.push($(this).attr('value'));
		console.log("Choix : "+$(this).attr('value')+" HTML : "+$(this).html());
	});
	if (trouver(tab, "choix4") || trouver(tab, "choix5") || trouver(tab, "choix6")){
		$("li[name='pSconcours']").addClass("sr-only");
		$("li[name='concours']").addClass("sr-only");
	}
	if (trouver(tab, "choix7") || trouver(tab, "choix8") || trouver(tab, "choix9")){
		console.log("cacher ceux la");
		$("li[name='pconcours']").addClass("sr-only");
		$("li[name='concours']").addClass("sr-only");
	}
	if (trouver(tab, "choix10") || trouver(tab, "choix11") || trouver(tab, "choix12")){
		$("li[name='pSconcours']").addClass("sr-only");
		$("li[name='pconcours']").addClass("sr-only");
	}

	if (trouver(tab, "choix0")){total1 = 0; optionsuivi = "Aucun"; suivicours = 0; }
	if (trouver(tab, "choixD")){total3 = 0; optioncours = "Aucun"; cours = 0; }

	if (trouver(tab, "choix1")) {total1 = 7; optionsuivi = "Semestre 1"; suivicours = 1; }
	if (trouver(tab, "choix2")) {total1 = 10; optionsuivi = "Semestre 2"; suivicours = 2; }
	if (trouver(tab, "choix3")) {total1 = 15; optionsuivi = "Annuel"; suivicours = 3; }

	if (trouver(tab, "choix4")) {total2 = 200; optionplanchage = "Avec concours : Semestre 1"; suiviplanchage = 1; }
	if (trouver(tab, "choix5")) {total2 = 250; optionplanchage = "Avec concours : Semestre 2"; suiviplanchage = 2; }
	if (trouver(tab, "choix6")) {total2 = 400; optionplanchage = "Avec concours : Annuel"; suiviplanchage = 3;}

	if (trouver(tab, "choix7")) {total2 = 60; optionplanchage = "Sans concours : Semestre 1";  suiviplanchage = 4; }
	if (trouver(tab, "choix8")) {total2 = 180; optionplanchage = "Sans concours : Semestre 2"; suiviplanchage = 5; }
	if (trouver(tab, "choix9")) {total2 = 230; optionplanchage = "Sans concours : Annuel"; suiviplanchage = 6; }

	if (trouver(tab, "choix10")) {total2 = 70; optionplanchage = "Uniquement concours : Semestre 1"; suiviplanchage = 7;}
	if (trouver(tab, "choix11")) {total2 = 70; optionplanchage = "Uniquement concours : Semestre 2"; suiviplanchage = 8;}
	if (trouver(tab, "choix12")) {total2 = 130; optionplanchage = "Uniquement concours : Annuel"; suiviplanchage = 9;}

	if (trouver(tab, "choix13")) {total3 = 250; optioncours = "Semestre 1"; cours = 1; }
	if (trouver(tab, "choix14")) {total3 = 300; optioncours = "Semestre 2"; cours = 2; }
	if (trouver(tab, "choix15")) {total3 = 500; optioncours = "Annuel"; cours = 3; }

	if (trouver(tab, "choixA") && trouver(tab, "choixB") && trouver(tab, "choixC")){
		if ($("li[name='pSconcours']").hasClass("sr-only"))
			$("li[name='pSconcours']").removeClass("sr-only");
		if ($("li[name='concours']").hasClass("sr-only"))
			$("li[name='concours']").removeClass("sr-only");
		if ($("li[name='pconcours']").hasClass("sr-only"))
			$("li[name='pconcours']").removeClass("sr-only");
		total2 = 0;
		optionplanchage = "Aucun";
		suiviplanchage = 0;
	}

	total = total1+total2+total3;
	$("#total").html("Total : "+total+"€");
}

$("select[name='choix']").change(function(){
	makeprix();
})

$("#offreseule").click(function(){
	if (!verification()){
		suiviplanchage = 4;
		suivicours = 0;
		cours = 0;
		total = 60;
		console.log("Afficher modal, prix : "+total);
		$("#recap").html("<b>Nom : </b>"+$("#nom").val()+"<br><b>Prénom : </b>"+$("#prenom").val()+"<br><b>Date de naissance : </b> "+$("#ddn").val()+" ("+(2019-parseInt($("#ddn").val()))+"ans)<br><b>Adresse : </b>"+$("#adresse").val()+" - "+$("#codepostale").val()+"<br>"+$("#ville").val()+"<br><b>Téléphone : </b>"+$("#tel").val()+"<br><b>E-mail : </b>"+$("#mail").val()+"<br><br><b>Offre : </b> Planchages entrainement Décembre 2019");
		$("#modalpayer").modal('show');
		$("#prix").html("Total à payer : "+total+"€");
	}
})

$("#pack1offre").click(function(){
	if (!verification()){
		cours = 1;
		suiviplanchage = 4;
		suivicours = 0;
		total = 300;
		$("#recap").html(
			"<b>Nom : </b>"+$("#nom").val()+
			"<br><b>Prénom : </b>"+$("#prenom").val()+
			"<br><b>Date de naissance : </b> "+$("#ddn").val()+" ("+(2019-parseInt($("#ddn").val()))+"ans)<br>"+
			"<b>Adresse : </b>"+$("#adresse").val()+" - "+$("#codepostale").val()+"<br>"+$("#ville").val()+
			"<br><b>Téléphone : </b>"+$("#tel").val()+"<br><b>E-mail : </b>"+$("#mail").val()+
			"<br><br><b>Offre : </b> Cours S1 + Planchages entrainement Décembre 2019");
		$("#modalpayer").modal('show');

		$("#prix").html("Total à payer : "+total+"€");
	}
})

$("#payer").click(function(){
	makeprix();
	if (!verification()){
		$("#recap").html("<b>Nom : </b>"+$("#nom").val()
			+"<br><b>Prénom : </b>"+$("#prenom").val()
			+"<br><b>Date de naissance : </b> "+$("#ddn").val()+" ("+(2019-parseInt($("#ddn").val()))
			+"ans)<br><b>Adresse : </b>"+$("#adresse").val()
			+" - "+$("#codepostale").val()+"<br>"+$("#ville").val()
			+"<br><b>Téléphone : </b>"+$("#tel").val()
			+"<br><b>E-mail : </b>"+$("#mail").val()
			+"<br><br><b>Vos options : </b><br><b>Suivi cours : </b>"+optionsuivi
			+"<br><b>Planchage : </b>"+optionplanchage
			+"<br><b>Supports cours : </b>"+optioncours);
		$("#modalpayer").modal('show');

		$("#prix").html("Total à payer : "+total+"€");
	}
})

$("#confirmer").click(function(){
	if ($("#confirmpassword").val() != $("#passwordinscription").val())
		$("#confirmpassword").addClass("btn-outline-danger");
	else {
		$("#paiement").empty().addClass("sr-only").html("<span id='btnpaypal'></span>");
		$("#confirmpassword").removeClass("btn-outline-danger");
		$(this).addClass('sr-only');
		$("#liconfirm").fadeOut().addClass('sr-only');
		$("#paiement").removeClass("sr-only").fadeIn();
		if (total > 0){
			paypal.Buttons({
				createOrder: function(data, actions){
					return actions.order.create({
						purchase_units: [{amount: { value: total}}]
					});
				},
				onApprove: function(data, actions) {
					return actions.order.capture().then(function(details) {
						$.post(
							'functions.php',
							{action: 1, nom : $("#nom").val(), prenom : $("#prenom").val(), ddn : $("#ddn").val(), mail : $("#mail").val(), adresse : $("#adresse").val(), codepostale : $("#codepostale").val(), ville : $("#ville").val(), telephone : $("#tel").val(), password : $("#passwordinscription").val(), bacserie : $("#bacserie").val(), mention : $("#mention").children("option:selected").html(), suivicours : suivicours, planchage : suiviplanchage, cours : cours, total: (total)},
							function(data){
								alert('Merci de votre inscription, vous recevrez un mail récapitulatif. Votre login : '+data);
								window.location = 'index.php';
							}
						);
					});
				}
			}).render('#btnpaypal');
		}
		else {
			$.post(
				'functions.php',
				{action: 1, nom : $("#nom").val(), prenom : $("#prenom").val(), ddn : $("#ddn").val(), mail : $("#mail").val(), adresse : $("#adresse").val(), codepostale : $("#codepostale").val(), ville : $("#ville").val(), telephone : $("#tel").val(), password : $("#passwordinscription").val(), bacserie : $("#bacserie").val(), mention : $("#mention").children("option:selected").html(), suivicours : suivicours, planchage : suiviplanchage, cours: cours, total: (total)},
				function (data){
					alert('Merci de votre inscription, vous recevrez un mail récapitulatif. Votre login : '+data);
					window.location = 'index.php';
				}, 'text'
			);
		}
	}
})

$("#modalpayer").on("hide.bs.modal", function(e){
	$("#confirmer").removeClass('sr-only');
	$("#liconfirm").fadeIn().removeClass('sr-only');
	$("#paiement").empty().addClass("sr-only").html("<span id='btnpaypal'></span>");
	cours = 0;
	suivicours = 0;
	suiviplanchage = 0;
	total = 0;
	total1 = 0;
	total2 = 0;
	total3 = 0;
})