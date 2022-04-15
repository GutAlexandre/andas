<?php
	// hash("sha1","salon"."testestest")
	
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Andas</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/conexion.css" type="text/css" media="screen">
	<script src="/js/jquery-3.6.0.min.js"></script>
	<script src="/js/bootstrap.bundle.min.js"></script>
	<script src="/js/firstconnection.js"></script>

</head>
 <body>
	 
		  <!-- The Modal -->
		  <div class="modal" id="modalconnexion">
			 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
				   <!-- Modal Header -->
				   <div class="modal-header">
					  <img id="icon" src="ressources\img\Logo.png">
						<h5 style="margin-right:46%;font-size: 200%;">Andas</h5>				   </div>
				   <!-- Modal body -->
				   <div class="modal-body" >
						<form action="" method="post" style="text-align:center">
						  <div class="form-group">
							<label for="login">Login</label></br>
							<input type="text" class="form-control" title="Login Invalide" id="login" name="login" aria-describedby="emailHelp" placeholder="Enter Login"></input>
							</div>
							<div class="form-group">
								<label for="InputPWD">Mot de passe</label></br>
								<input type="password" class="form-control" id="InputPWD" name="InputPWD" placeholder="Password"></input>
							</div>
							<div class="form-group">
								<label for="InputPWD2">Confirm Mot de passe</label></br>
								<input type="password" class="form-control" id="InputPWD2" name="InputPWD2" placeholder="Password"></input>
							</div>
							
							<input type="checkbox" onclick="ShowPWD()">Show Password</input>
							</br>
							<font  size="1">Le mot de passe doit contenir des chiffres, lettres minuscules et majuscule (min.8 carac.)</font >
							</br>
							<hr>
							</br>
							<div class="d-grid gap-2">
								<button id="Submit" type="button" class="btn btn-success btn-lg btn-block" style="background: linear-gradient(45deg,MediumOrchid, blue);filter: brightness(1.2);"><h5>Submit</h5></button>
							</div>
							<p>deja un compte ? :<a href="./index.php">Cliquez ici</a></p>
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