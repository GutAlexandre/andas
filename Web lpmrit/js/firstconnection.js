$(document).ready(function() { 
	$("#modalconnexion").show();
	
	$("#Submit").click(function(){
		if($('#InputPWD').val() != $('#InputPWD2').val()){
			alert("Mots de passe different !");
		}else{
			if($("#login").val() != "" & $("#InputPWD").val() != "" ){
				var num = 0;
				var lower = 0;
				var upper = 0;
				var strings = $('#InputPWD').val(); 
				var i=0; 
				var character=''; 
				if((strings.length-1) > 6 ){
					while (i <= strings.length-1){ 
						character = strings.charAt(i);
						if (!isNaN(character * 1)){ 
							num = num+ 1;
						}else{ 
							if (character == character.toUpperCase()) { 
								upper = upper+ 1;
							} 
							if (character == character.toLowerCase()){ 
								lower = lower+ 1;
							} 
						} 
						i++;
					}
					if(lower>=1){
						if(upper>=1){
							if(num>=1){
								$.get( "/api.php?search="+ $('#login').val() + $('#InputPWD').val(), function( data ) {
									console.log(data);
									if(data == "null"){
										$.get( "/api.php?add_loginweb="+ $('#login').val() + $('#InputPWD2').val() +"&mdp_user=" + $('#InputPWD').val()+"&login="+ $('#login').val(), function( data ){
											console.log(data);
											alert("Utilisateur  "+ $('#login').val()+ " créer");
											document.location.href="index.php"
										});
									}else{
										alert("Utilisateur deja existant")
									}
								});
							}else{
								alert("Le mot de passe doit contenir au moins un chiffre");
							}
						}else{
							alert("Le mot de passe doit contenir au moins une majuscule");
						}
					}else{
						alert("Le mot de passe doit contenir au moins une minuscule");
					}
				}else{
					alert("Minimum 8 caractères");
				}
			}
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
	var x = document.getElementById("InputPWD2");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
	