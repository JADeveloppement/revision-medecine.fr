$("span[class='badge badge-success']").each(function(){
	$(this).fadeOut("fast");
});

var id2;
function search(){
	$("#wait").addClass("sr-only");
	
	if ($("input[type='search']").val().length == 0){
		$("#rechercher").empty();
	}
	if ($("input[type='search']").val().length >= 1){
		$("li[abs='search']").each(function(){
			if ($(this).html().toLowerCase().search($("input[type='search']").val().toLowerCase()) !== -1 && $(this).html().toLowerCase().search("abs='"+$("input[type='search']").val().toLowerCase()+"'") == -1)
				$("#rechercher").append("<li class='list-group-item'>"+$(this).html()+"</li>");
			else {
				
			}
		})
	}
	else {
		$("#rechercher").empty();
	}
}

$("input[type='search']").keyup(function (e) {
	$("#rechercher").empty();
	$("#wait").removeClass("sr-only");
	clearTimeout(id2);
	id2 = setTimeout(search, 750);
});

$("input[name='search']").click(function(){
	if ($(this).val().length <= 1){
		$("#rechercher").empty();
	}
})

//#fXX btn fiché 
//#eXX btn éditer 
//#bXX "enregistré !"
//#sXX spinner border
//#rXX btn relu

function changed(a, b){
	$("#s"+a).html(b);
	$("#searchspanrelu"+a).html(b);
	$("#r"+a).attr("disabled", false);
	$("#e"+a).attr("disabled", false);
	$("#f"+a).attr("disabled", false);
	$("#b"+a).fadeIn().fadeOut();
	$("span[name='spinner"+a+"']").removeClass('spinner-border');
	if (b >= 3){
		$("#r"+a).removeClass("btn-outline-danger").addClass("btn-outline-success");
		$("#Sbtnrelu"+a).removeClass("btn-outline-danger").addClass("btn-outline-success");
	}
	else {
		$("#r"+a).addClass("btn-outline-danger").removeClass("btn-outline-success");
		$("#Sbtnrelu"+a).addClass("btn-outline-danger").removeClass("btn-outline-success");
	}
}

function beforeget(a){
	$("#r"+a).attr("disabled", true);
	$("#e"+a).attr("disabled", true);
	$("#f"+a).attr("disabled", true);
	$("span[name='spinner"+a+"']").addClass('spinner-border');
}

function fiched(a, b){
	if (b == 0){
		$("#f"+a).removeClass("btn-outline-success").addClass("btn-outline-danger").html("Fiché : Non");
		$("#searchfiche"+a).removeClass("btn-outline-success").addClass("btn-outline-danger").html("Fiché : Non");
	}
	else {
		$("#f"+a).removeClass("btn-outline-danger").addClass("btn-outline-success").html("Fiché : Oui");
		$("#searchfiche"+a).removeClass("btn-outline-danger").addClass("btn-outline-success").html("Fiché : Oui");
	}
	$("#f"+a).attr("disabled", false);
	$("#e"+a).attr("disabled", false);
	$("#r"+a).attr("disabled", false);
	$("span[name='spinner"+a+"']").removeClass('spinner-border');
	$("#b"+a).fadeIn().fadeOut();

}

$("button[name='relu']").click(function(){
	var nb = $(this).attr('abs');
	beforeget(nb);

	$.get(
		'functions.php',
		{action: 3, nbitem: nb},
		function(data){
			changed(nb, data);
		},
		'text'
	);
})

$("button[name='fiche']").click(function(){
	nb = $(this).attr('abs');
	$("#f"+nb).attr("disabled", true);
	$("#e"+nb).attr("disabled", true);
	$("#r"+nb).attr("disabled", true);
	$("span[name='spinner"+nb+"']").addClass('spinner-border');
	$.get(
		'functions.php',
		{action: 4, nbitem: nb},
		function(data){
			fiched(nb, data);
		},
		'text'
	);
})

$("button[name='editer']").click(function(){
	var nb = $(this).attr('abs');
	if ($("input[name='e"+nb+"']").val().length == 0)
		$("input[name='e"+nb+"']").addClass("btn-outline-danger");
	else {
		$("input[name='e"+nb+"']").removeClass("btn-outline-danger");
		beforeget(nb);
		$.get(
			'functions.php',
			{action: 5, nbitem: nb, nv: $("input[name='e"+nb+"']").val()},
			function (data){
				changed(nb, data);
			},
			'text'
		);
	}
})

/** FONCTION RECHERCHER **/

var timeoutid;
var timeoutid2;
function unfocus(){
	$("#searchitem").blur();
}
function rechercher(){
	$("#rechercher").addClass("sr-only");
	if ($("#searchitem").val().length <= 2){
		$("div[abs='item']").each(function(){
			if (!$(this).parent().parent().hasClass("sr-only"))
				$(this).parent().parent().addClass("sr-only");
		});
	}
	else {
		var kw = $("#searchitem").val();
		$("div[abs='item']").each(function(){
			if ($(this).html().indexOf(kw) != -1){
				$(this).parent().parent().removeClass('sr-only');
			}
			else {
				if (!$(this).parent().parent().hasClass('sr-only'))
					$(this).parent().parent().addClass('sr-only')
			}
		});
	}
}
$("#searchitem").keyup(function(e){
	clearTimeout(timeoutid);
	clearTimeout(timeoutid2);
	$("#rechercher").removeClass("sr-only");
	timeoutid = setTimeout(rechercher, 1000);
	timeoutid2 = setTimeout(unfocus, 2500);
});

$("button[abs='Sbtnrelu']").click(function(){
	item = parseInt($(this).attr("indice"));
	$("#Sbtnrelu"+item).attr('disabled', true);
	$("#searchfiche"+item).attr('disabled', true);
	$("#Sbtnedit"+item).attr('disabled', true);
	$.get(
		'functions.php',
		{action: 3, nbitem: item},
		function(data){
			$("#Sbtnrelu"+item).attr('disabled', false);
			$("#searchfiche"+item).attr('disabled', false);
			$("#Sbtnedit"+item).attr('disabled', false);
			$("#searchsaved"+item).fadeIn();
			$("#searchsaved"+item).fadeOut();
			$("#searchspanrelu").html(data);
			changed(item, data);
		}
	);
});

$("button[abs='Sbtnfiche']").click(function(){
	item = parseInt($(this).attr("indice"));
	$("#Sbtnrelu"+item).attr('disabled', true);
	$("#searchfiche"+item).attr('disabled', true);
	$("#Sbtnedit"+item).attr('disabled', true);
	$.get(
		'functions.php',
		{action: 4, nbitem: item},
		function(data){
			$("#Sbtnrelu"+item).attr('disabled', false);
			$("#searchfiche"+item).attr('disabled', false);
			$("#Sbtnedit"+item).attr('disabled', false);
			$("#searchsaved"+item).fadeIn();
			$("#searchsaved"+item).fadeOut();
			fiched(item, data);
		}
	);
})

$("button[abs='Sbtnedit']").click(function(){
	item = parseInt($(this).attr("indice"));
	if ($("input[abs='Sinputedit"+item+"']").val().length == 0){
		$("input[abs='Sinputedit"+item+"']").addClass('btn-outline-danger');
	}
	else {
		$("input[abs='Sinputedit"+item+"']").removeClass('btn-outline-danger');
		$("#Sbtnrelu"+item).attr('disabled', true);
		$("#searchfiche"+item).attr('disabled', true);
		$("#Sbtnedit"+item).attr('disabled', true);
		nvnb = parseInt($("input[abs='Sinputedit"+item+"']").val());
		$.get(
			'functions.php',
			{action: 5, nbitem: item, nv: nvnb},
			function(data){
				$("#Sbtnrelu"+item).attr('disabled', false);
				$("#searchfiche"+item).attr('disabled', false);
				$("#Sbtnedit"+item).attr('disabled', false);
				$("#searchsaved"+item).fadeIn();
				$("#searchsaved"+item).fadeOut();
				$("input[abs='Sinputedit"+item+"']").attr('value', '');
				changed(item, data);
			}
		);
	}
})

function updatesearch(){
	for(i = 0; i < 362; i++){
		$("#searchspanrelu"+i).html($('#s'+i).html());
		if ($("#f"+i).html().indexOf("Oui") != -1)
			$("#searchfiche"+i).html("Fiché : Oui").removeClass("btn-outline-danger").addClass("btn-outline-success");
	}
}
updatesearch();