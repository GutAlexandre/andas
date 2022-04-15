
$(document).ready(function() { 
	
		
	fetch('https://api.openweathermap.org/data/2.5/weather?q=Paris&units=metric&appid=0cc4a40971502198ffeca35d0bb551fb&lang=fr')
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
	
	$("#modal1").show();	
	
	$("#slideThree").click(function(){
		var checkBox = document.getElementById("slideThree");
		var text = document.getElementById("State");
		
		if (checkBox.checked == true){
			text.innerHTML = "Déshumidificateur OFF";
			document.getElementById("customRange3").disabled=true;
			text.style.color = "red";
			$.get( "/api.php?get=*&where=log", function( data ) {
				console.log(data);
			});
		} else {
			text.innerHTML = "Déshumidificateur ON";
			document.getElementById("customRange3").disabled=false;
			text.style.color = "green";
			$.get( "/api.php?get=*&where=connexion", function( data ) {
				console.log(data);
			});
		}
	});
	$("#about").click(function(){
		$("#modalabout").show();
		
	});
	
	$("#close").click(function(){
		$("#modalabout").hide();
		
	});
	$("#settings").click(function(){
		$("#modalsettings").show();
		
		
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
	$.get( "/api.php?get=*&where=log", function( data3 ) {
		donnée = JSON.parse(data3);
		table.replaceData(donnée);
	});	
}
