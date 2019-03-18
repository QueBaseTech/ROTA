<?php if(!isset($_SESSION['userName']) || empty($_SESSION['userName']) ){
	$_SESSION["ErrorMessage"] = "Log in First";
    header('location: ../index.php');
    exit;
    }
    if($_SESSION["userName"] == "admin"){
	  $_SESSION["ErrorMessage"] = "Please login first";
	    header('location: ../index.php');
	    exit;
	    }

?>