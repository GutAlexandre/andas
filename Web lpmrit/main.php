<?php
	If(@$_COOKIE["auth"] != "" ){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT id FROM "connexion";';
		$results = $db->query($sql);
		if(!$results){
			echo(console.log($db->lastErrorMsg()));
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			$id =  json_encode($rows);	
			if(!str_contains($id, @$_COOKIE["auth"])){
				header("Location: /index.php");
			}
		}
	}else{
		header("Location: /index.php");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Andas</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/tabulator.min.css">
	<link rel="stylesheet" href="/css/tabulator_bootstrap4.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	
	<script src="/js/jquery-3.6.0.min.js"></script>
	<script src="/js/tabulator.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script src="/js/jquery_wrapper.js"></script>
	
	<script src="/js/bootstrap.bundle.min.js"></script>
	
	<script src="/js/main.js"></script>
</head>
<body>

	<!-- The Modal -->
		  <div class="modal " id="modal1">
			 <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable modal-lg">
				<div class="modal-content">
				    <!------------------>
				    <!-- Modal Header -->
					<!------------------>
					
					<div class="modal-header" style="background:#fcf8fd">
						<p>
							<img id="logo" src="ressources\img\Logo.png"></img>
							<text id="nom" class="text-left">Andas 
								
							<div id="current_date">
								<script>
									date = new Date();
									year = date.getFullYear();
									month = date.getMonth() + 1;
									day = date.getDate();
									document.getElementById("current_date").innerHTML = month + "/" + day + "/" + year;
								</script>
								<img id="weather"></img>
								<div id="current_weather"></div>
							</div>
							
						
						

						<div class="dropdown">
							<button id="Deconnection" type="button" class="btn btn-danger" onclick="deleteCookies()"><h5>Deconnection</h5></button>
							<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							User
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" type="button" id="settings" href="#">Settings</a></li>
								<li><a class="dropdown-item" type="button" id="about" href="#">About</a></li>
							</ul>
						
					  					  
						</div>
						</p>
					</div>
				   <!---------------->
				   <!-- Modal body -->
				   <!---------------->
				   <div class="modal-body" >
					   <!-------------------->
					   <!-- partie weather -->
					   <!-------------------->
						<div class="part1">
							<div class="slideThree" >
								<input type="checkbox" value="None" id="slideThree" name="check" style='visibility:hidden' />
								<label for="slideThree" ></label>
								<p id="State" style="inline-block; color:green;" >Déshumidificateur ON</p>	
							</div>
							
							
						</div>
						<div class="vertical-line1"></div>
						<div class="hline-bottom"></div>
						<div class="part12">
							<label id="ventil" for="customRange3" class="form-label">Ventilation</label>
							<input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
						</div>
						<div class="hline-bottom-v-t"></div>
						
						</br>
						<!-------------------->
						<!-- partie Capteur -->
						<!-------------------->
						<div class="part2">
							<div class="vertical-line1"></div>
								
						</div>
						<div class="part22">
							<label id="ventil" for="customRangetemp" class="form-label">Temperature</label>
							<input type="range" class="form-range " min="0" max="100" step="0.1" id="customRangetemp">
						</div>
						<div class="vertical-line1"></div>
						<div class="hline-bottom"></div>
						
						
						<!-------------------->
						<!-- partie Control -->
						<!-------------------->
						
										
						</br>
						<div class="part30">
							
								<div class="container" style="text-align:center">
									<div id="ctable"></div>
								</div>
							
					</div>
				</div>
			 </div>
		  </div>
		  
		  
		  
		   <!-- The Modal about -->
		  <div class="modal" id="modalabout">
			 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h5 class="Titre" style="text-align:center;" > About</h5>
						<button type="button" id="close" class="btn btn-danger" style="text-right">Close</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body" >
							<h5>Bienvenue sur Andas</h5>
							<p>Andas est un déshumidificateur connecté développer par .... dans le cadre d'un projet académique au seins de l'université Sorbonne Paris Nord.
							Ce déshumidificateur a pour but d’intégrer les fonctions basiques attendu par ce dernier ainsi que d’offrir une plateforme permettant de monitorer notre objet apportant des fonctions novatrices tels-que l’inversion de la rotation des ventilateurs pour réchauffer une pièce.

							Ce projet a été conçu à l’aide des langages suivant :C, javascript, HTML, CSS, SQL, Android, Bash.
							</p>
							<p style="text-align:center">© Andas 2021-2022</p>	
					
					</div>
				</div>
			 </div>
		  </div>
		  
		  
		  		   <!-- The Modal Settings -->
		 <div class="modal" id="modalsettings">
			 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
				   <!-- Modal Header -->
				   <div class="modal-header">
					  <p> Settings</p>
						<button type="button" id="closesettings" class="btn btn-danger" style="text-right">Close</button>
				   </div>
				   <!-- Modal body -->
				   <div class="modal-body" >
						<form action="" method="post" style="text-align:center">
						  <div class="form-group">
							<label for="ssid">SSID</label></br>
							<input type="text" class="form-control" title="ssid Invalide" id="login" name="login" aria-describedby="emailHelp" placeholder="Enter SSID"></input>
						  </div>
						  <div class="form-group">
							<label for="InputWPA">Mot de passe WPA/WEP</label></br>
							<input type="password" class="form-control" id="InputWPA" name="InputWPA" placeholder="Password"></input>
						  </div>
						  <div class="form-group">
							<label for="name">Nom de l'objet</label></br>
							<input type="text" class="form-control" title="Name Invalide" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name"></input>
						  </div>
						  <div class="form-group">
							<label for="InputPWD">Mot de passe objet</label></br>
							<input type="password" class="form-control" id="InputPWD" name="InputPWD" placeholder="Password"></input>
						  </div>
						  <input type="checkbox" onclick="ShowPWD()">Show Passwords</input>
						
							</br>
							<hr>
							</br>
							<div class="d-grid gap-2">
								<button id="Submit" type="Submit" class="btn btn-success btn-lg btn-block" ><h5>Submit</h5></button>
							</div>
							<div class="toast" id="toast1" data-delay="2000" style="position: absolute; top: 1rem; right: 1rem; min-width:200px;" aria-live="assertive" aria-atomic="true">
								<div class="toast-header">
									<strong class="mr-auto">Identifiant incorrect</strong>
										
								</div>							
							</div>	
						</form>						
					</br>
					</div>
				</div>
			 </div>
		  </div>
</body>
</html>

				