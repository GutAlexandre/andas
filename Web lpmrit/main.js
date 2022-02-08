
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
		} else {
			text.innerHTML = "Déshumidificateur ON";
			document.getElementById("customRange3").disabled=false;
			text.style.color = "green";
		}
	});
	
});

