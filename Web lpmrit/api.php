<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	
	if(@$_GET["gettab"] != null ){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT '.$_GET["gettab"].' FROM "'.$_GET["where"].'" WHERE id="'.@$_COOKIE["auth"].'";';
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			echo json_encode($rows,JSON_PRETTY_PRINT);		
		}
		// while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			// echo json_encode($rows,JSON_PRETTY_PRINT);
	}
	
	if(@$_GET["getcontent"] != null ){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT '.$_GET["getcontent"].' FROM "'.$_GET["where"].'"WHERE id="'.$_GET["hasha"].'";';;
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			
			echo json_encode($rows,JSON_PRETTY_PRINT);		
		}
	}
	
	if(@$_GET["get"] != null ){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT '.$_GET["get"].' FROM "'.$_GET["where"].'";';
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			echo json_encode($rows,JSON_PRETTY_PRINT);		
		}
	}
	
	if(@$_GET["getloc"] != null ){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT '.$_GET["getloc"].' FROM "'.$_GET["where"].'" WHERE id="'.@$_COOKIE["auth"].'";';
		$results = $db->query($sql);
		while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
		echo json_encode($rows,JSON_PRETTY_PRINT);
	}
	
	if(@$_GET["hash"] != null ){
		$results = hash("sha1",@$_GET["hash"]);
		echo $results;
	}

	if(!empty(@$_GET["update"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE "'.$_GET["where"].'" SET '.$_GET["what"].'="'.$_GET["value"].'" WHERE id = "'.$_GET["update"].'";'; 
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		echo console.log("succes");
	}
	
	if(!empty(@$_GET["save"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE log SET temp="'.$_GET["temp"].'" WHERE id = "'.$_GET["save"].'";'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		
		$sql = 'UPDATE log SET humidite="'.$_GET["humidite"].'" WHERE id = "'.$_GET["save"].'";'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		
		$sql = 'UPDATE log SET niv_eau="'.$_GET["niv_eau"].'" WHERE id = "'.$_GET["save"].'";'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		
		$sql = 'UPDATE log SET moy_humi="'.$_GET["moy_humi"].'" WHERE id = "'.$_GET["save"].'";'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		
		$sql = 'UPDATE log SET moy_temp="'.$_GET["moy_temp"].'" WHERE id = "'.$_GET["save"].'";'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		
	}
	
	if(!empty(@$_GET["createid"])){
		$db = new SQLite3('./andas.db');
		$sql = 'INSERT INTO log(id) VALUES("'.$_GET["createid"].'";'; 
		$results = $db->exec($sql);
		$sql = 'INSERT INTO status(id) VALUES("'.$_GET["createid"].'";'; 
		$results = $db->exec($sql);
		
	}
		
	if(!empty(@$_GET["save_wifi"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE connexion SET ssid="'.$_GET["ssid"].'" WHERE id = "'.$_GET["save_wifi"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET mdp_wifi="'.$_GET["mdp_wifi"].'" WHERE id = "'.$_GET["save_wifi"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET login="'.$_GET["login"].'" WHERE id = "'.$_GET["save_wifi"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET mdp_user="'.$_GET["mdp_user"].'" WHERE id = "'.$_GET["save_wifi"].'";'; 
		$results = $db->query($sql);
	}
	
	if(!empty(@$_GET["save_wifi_web"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE connexion SET ssid="'.$_GET["ssid"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET mdp_wifi="'.$_GET["mdp_wifi"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET login="'.$_GET["login"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE connexion SET mdp_user="'.$_GET["mdp_user"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		
		$sql = 'UPDATE log SET localisation="'.$_GET["ville"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
	}
	
	if(!empty(@$_GET["add"])){
		$db = new SQLite3('./andas.db');
		$sql = ' INSERT INTO log(temp,niv_eau,humidite,moy_humi,moy_temp,localisation) VALUES('.@$_GET["temp"].','.@$_GET["niv_eau"].','.@$_GET["humidite"].','.@$_GET["moy_humi"].','.@$_GET["moy_temp"].',"'.@$_GET["localisation"].'");'; 
		
		$results = $db->exec($sql);
		
	}
	if(!empty(@$_GET["add_login"])){
		$db = new SQLite3('./andas.db');
		$sql = 'INSERT INTO connexion( id ,ssid ,mdp_wifi ,login ,mdp_user) VALUES("'.@$_GET["add_loginweb"].'","'.@$_GET["ssid"].'","'.@$_GET["mdp_wifi"].'","'.@$_GET["login"].'","'.@$_GET["mdp_user"].'");'; 
		
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
	}
	if(!empty(@$_GET["add_loginweb"])){
		$db = new SQLite3('./andas.db');
		$sql = 'INSERT INTO connexion( id ,login ,mdp_user) VALUES("'.hash("sha1",@$_GET["add_loginweb"]).'","'.@$_GET["login"].'","'.@$_GET["mdp_user"].'");'; 
		
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
	}
	if(!empty(@$_GET["createidweb"])){
		$db = new SQLite3('./andas.db');
		$sql = 'INSERT INTO log(id) VALUES("'.hash("sha1",$_GET["createidweb"]).'");'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		$sql = 'INSERT INTO status(id) VALUES("'.hash("sha1",$_GET["createidweb"]).'");'; 
		$results = $db->exec($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
	}

	
	if(!empty(@$_GET["search"])){
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT "login" from connexion WHERE id="'.hash("sha1",@$_GET["search"]).'";'; 
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}elseif($results = "null"){
			echo($results);
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			echo json_encode($rows,JSON_PRETTY_PRINT);
		}
	}
	if(!empty(@$_GET["getinfo"])){
		//header('Content-Type: application/json; charset=utf-8');
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT * from connexion WHERE id="'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
		echo json_encode($rows,JSON_PRETTY_PRINT);
	}
	
	if(!empty(@$_GET["setcookie"])){
		setcookie("auth", @$_GET["setcookie"] , time()+3600 * 10);
		header("Location: /main.php");
	}
	
	if(@$_GET["getjava"] != null ){
		header('Content-Type: application/json; charset=utf-8');
		$db = new SQLite3('./andas.db');
		$sql = 'SELECT '.$_GET["getjava"].' FROM "'.$_GET["where"].'";';
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			while($row=$results->fetchArray(SQLITE3_ASSOC)) { $rows[]=$row; }
			echo json_encode($rows,JSON_PRETTY_PRINT);		
		}
	}
	
	if(!empty(@$_GET["updatebp"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE "'.$_GET["where"].'" SET '.$_GET["what"].'="'.$_GET["value"].'" WHERE id = "'.@$_COOKIE["auth"].'";'; 
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		echo console.log("succes");
	}
	if(!empty(@$_GET["updatebpjava"])){
		$db = new SQLite3('./andas.db');
		$sql = 'UPDATE "'.$_GET["where"].'" SET '.$_GET["what"].'="'.$_GET["value"].'" WHERE id = "'.@$_GET["auth"].'";'; 
		$results = $db->query($sql);
		if(!$results){
			echo $db->lastErrorMsg();
		}
		else{
			echo "Records created successfully\n";
		}
		echo console.log("succes");
	}
	
?>