<?php 
	require_once("../config/sessions.php");
	require_once("../config/pdoconnect.php");

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		//Sanitizing
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$userName = $_SESSION["userName"];
		$Date = trim($_POST["Date"]);
		$morningDuty = trim($_POST["morningDuty"]);
		$morningVenue = trim($_POST["morningVenue"]);
		$afternoonDuty = trim($_POST["afternoonDuty"]);
		$afternoonVenue = trim($_POST["afternoonVenue"]);
		$comment = trim($_POST["comment"]);

		
	    // our SQL statements
	    $stmt = $conn->prepare("INSERT INTO rotausersduty (userName,dutyDate,morningDuty,morningVenue,afternoonDuty,afternoonVenue,comment) 
	    VALUES (:userName,:dutyDate, :morningDuty,:morningVenue,:afternoonDuty,:afternoonVenue,:comment)");
	    $stmt->bindParam(':userName', $userName);
	    $stmt->bindParam(':dutyDate', $Date);
	    $stmt->bindParam(':morningDuty', $morningDuty);
	    $stmt->bindParam(':morningVenue', $morningVenue);
	    $stmt->bindParam(':afternoonDuty', $afternoonDuty);
	    $stmt->bindParam(':afternoonVenue', $afternoonVenue);
	    $stmt->bindParam(':comment', $comment);

	    if ($stmt->execute()) {
	    	$_SESSION["SuccessMessage"] = "Records created successfully";
	    	header("Location: index.php");
	    	exit;
	    };

		}else{
			$_SESSION["ErrorMessage"] = "You're not supposed to be here";
			header("Location: ../");
		}
	

 ?>