<?php if(!isset($_SESSION['userName']) || empty($_SESSION['userName']) ){
	$_SESSION["ErrorMessage"] = "Log in First";
    header('location: ../index.php');
    exit;
    }

?>