<?php

	//functions.php
	require_once("../configglobal.php");
	$database = "if15_kenaon";

	//loome uue funktsiooni, et küsida ab'ist andmeid
	function getCarData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates");
		$stmt->bind_result($id, $user_id, $number_plate, $color_from_db);
		$stmt->execute();
		
		//tühi massiiv kus hoiame objekte( 1 rida andmeid)
		$array = array();
		
		//tee tsüklit nii mitu korda, kui saad ab'st ühe rea andmeid
		while($stmt->fetch()){
		
			//loon objekti
			$car = new stdClass();
			$car->id = $id;
			$car->number_plate = $number_plate;
			
			//lisame selle massiivi
			array_push($array, $car);
			echo "<pre>";
			var_dump($array);
			echo "</pre>";
			//echo $array;
		}
		$stmt->close();
		$mysqli->close();
	}

	getCarData();
?>