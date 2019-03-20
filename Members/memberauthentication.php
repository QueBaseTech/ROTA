<?php if(!isset($_SESSION['userName']) || empty($_SESSION['userName']) ){
    header('location: ../index.php');
	$_SESSION["ErrorMessage"] = "Log in First";
    exit;
    }
    if($_SESSION["userName"] == "admin"){
	  $_SESSION["ErrorMessage"] = "Please login first";
	    header('location: ../index.php');
	    exit;
	    }

?>