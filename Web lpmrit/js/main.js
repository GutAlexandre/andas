
$(document).ready(function() { 
	$.get( "/api.php?getloc=temp&where=log", function( temp ) {
		temp = JSON.parse(temp);
		document.getElementById('customRangetemp').value = temp[0]['temp'];;
	});	
	$.get( "/api.php?getloc=vitVentil&where=status", function( vitVentil ) {
		vitVentil = JSON.parse(vitVentil);
		document.getElementById('customRange3').value = vitVentil[0]['vitVentil'];;
	});	
	$.get( "/api.php?getloc=statusVentil&where=status", function( statusVentil ) {
		statusVentil = JSON.parse(statusVentil);
		var text = document.getElementById("State");
		if(statusVentil[0]['statusVentil'] == "on"){
			document.getElementById('slideThree').checked = false;
			console.log("oui");
			text.innerHTML = "Déshumidificateur ON";
			document.getElementById("customRange3").disabled=false;
			text.style.color = "green";
		}else{
			document.getElementById('slideThree').checked = true;
			console.log("non");
			text.innerHTML = "Déshumidificateur OFF";
			document.getElementById("customRange3").disabled=true;
			text.style.color = "red";
		}

	});	

	$.get( "/api.php?getloc=localisation&where=log", function( loc ) {
		ville = JSON.parse(loc);
		fetch('https://api.openweathermap.org/data/2.5/weather?q=' + ville[0]["localisation"] +'&units=metric&appid=0cc4a40971502198ffeca35d0bb551fb&lang=fr')
		.then(response => response.json())
		.then(data => {
			console.log(data);
			var nameValue = data['name'];
			var tempValue = data['main']['temp'];
			var descValue = data['weather'][0]['description'];
			var iconValue = data['weather'][0]['icon'];
			
			document.getElementById('weather').src = 'http://openweathermap.org/img/wn/' + iconValue + '@2x.png'
			console.log('http://openweathermap.org/img/wn/' + iconValue + '@2x.png')
		});
	});
	
	$("#modal1").show();	
	
	$("#slideThree").click(function(){
		var checkBox = document.getElementById("slideThree");
		var text = document.getElementById("State");
		
		if (checkBox.checked == true){
			text.innerHTML = "Déshumidificateur OFF";
			document.getElementById("customRange3").disabled=true;
			text.style.color = "red";
			
			$.get( "/api.php?updatebp=*&where=status&what=statusVentil&value=off", function( data ){
				
			});
		} else {
			text.innerHTML = "Déshumidificateur ON";
			document.getElementById("customRange3").disabled=false;
			text.style.color = "green";
			$.get( "/api.php?updatebp=*&where=status&what=statusVentil&value=on", function( data ){
				
			});
		}
	});
	$("#customRange3").on("change",function () {
		console.log($("#customRange3").val());
		$.get( "/api.php?updatebp=*&where=status&what=vitVentil&value=" + $("#customRange3").val(), function( data ){
				
			});
	});

	
	$("#about").click(function(){
		$("#modalabout").show();
		
	});
	
	$("#close").click(function(){
		$("#modalabout").hide();
		
	});
	$("#Submitopt").click(function(){
		$.get( "/api.php?save_wifi_web=*&ssid="+ $('#login').val() +"&mdp_wifi=" + $('#InputWPA').val() + "&login=" + $('#name').val() + "&mdp_user=" + $('#InputPWD').val()+"&ville=" + $('#ville').val() , function( data ) {
			console.log(data);
		});
		alert("Changement pris en compte");
		$("#modalsettings").hide();
		
	});
	
	$("#settings").click(function(){
		$("#modalsettings").show();
		$.get( "/api.php?getloc=localisation&where=log", function( loc ) {
				
				console.log(loc);
				ville = JSON.parse(loc);
				document.getElementById("ville").value = ville[0]["localisation"];

		});
		$.get( "/api.php?getinfo=*&where=connexion", function( data ) {
				console.log(data);
				info = JSON.parse(data);
				document.getElementById("login").value = info[0]["ssid"];
				document.getElementById("InputWPA").value = info[0]['mdp_wifi'];
				document.getElementById("name").value = info[0]['login'];
				document.getElementById("InputPWD").value = info[0]['mdp_user'];
		});
		
	});
	
	$("#closesettings").click(function(){
		$("#modalsettings").hide();
		
	});
	tabulator()
});

function deleteCookies() {
				
                var allCookies = document.cookie.split(';');
                
                // The "expire" attribute of every cookie is 
                // Set to "Thu, 01 Jan 1970 00:00:00 GMT"
                for (var i = 0; i < allCookies.length; i++)
                    document.cookie = allCookies[i] + "=;expires="
                    + new Date(0).toUTCString();
  
                // displayCookies.innerHTML = document.cookie;
				document.location="/index.php"
  
            }
			
function tabulator() {
	var table = new Tabulator("#ctable", {
		height:120, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
		layout:"fitDataFill", //fit columns to width of table (optional)
		columns:[ //Define Table Columns
			{title:"Température", field:"temp"},
			{title:"Température moyenne", field:"moy_temp"},
			{title:"Humidité", field:"humidite"},
			{title:"Humidité moyenne", field:"moy_humi"},
			{title:"Niveau d'eau", field:"niv_eau"},
			],
						
	});
	$.get( "/api.php?gettab=*&where=log", function( data3 ) {
		donnée = JSON.parse(data3);
		table.replaceData(donnée);
	});	
}
function ShowPWD() {
	var x = document.getElementById("InputPWD");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
	var x = document.getElementById("InputWPA");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}