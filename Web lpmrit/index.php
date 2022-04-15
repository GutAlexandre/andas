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
			if(str_contains($id, @$_COOKIE["auth"])){
				header("Location: /main.php");
			}
		}
	}
	
	// If(@$_COOKIE["auth"] == hash("sha1", "root"."Andas") ){

		// header("Location: /main.php");
	// }

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
	<script src="/js/conexion.js"></script>

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
						  <input type="checkbox" onclick="ShowPWD()">Show Password</input>
						
							</br>
							<hr>
							</br>
							<div class="d-grid gap-2">
								<button id="Submit" type="button" class="btn btn-success btn-lg btn-block" style="background: linear-gradient(45deg,MediumOrchid, blue);filter: brightness(1.2);"><h5>Submit</h5></button>
							</div>
							<p>creer un compte :<a href="./firstconnection.php">Register</a></p>
							
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