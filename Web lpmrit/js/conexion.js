$(document).ready(function() { 
	$("#modalconnexion").show();
	$("#Submit").click(function(){
		if($("#login").val() != "" & $("#InputPWD").val() != "" ){
			$.get( "/api.php?get=id&where=connexion", function( data ){
				console.log(data);
				$.get( "/api.php?hash=" + $("#login").val() + $("#InputPWD").val(), function( hash ){
					console.log(hash);
					if(data.includes(hash) ==true){
						$.get( "/api.php?setcookie="+ hash, function( res ){
							document.location.href="main.php"
						});
					}else{
						console.log("nop");
					}
				});
			});
		}else{
			alert("Le login ou l'identifiant ne doit pas etre null");
		}
	});
	$("#InputMail").on('change', function() {
		var str = $("#InputMail").val()
		if(str.includes("@")  ){
			$('#InputMail').tooltip('disable');
		}else{
			$('#InputMail').tooltip('enable');
			$('#InputMail').tooltip('show');
		}
   
		if($("#InputMail").val() != 'Null'){$('#Submit').prop("disabled", false);}
		else if($("#InputMail").val() == 'Null') {$('#Submit').prop("disabled", true);}
	});
	

 
});

function ShowPWD() {
	var x = document.getElementById("InputPWD");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
	