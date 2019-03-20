<?php
	$userName = $_GET["userName"];
 ?>
<!DOCTYPE html>
<html>
<title><?php echo $userName ?> Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-container">
  <h2> <?php echo $userName; ?> </h2>
  <img class="w3-animate-fading" src="../img/eagle.jpg" style="width:100%">
</div>

</body>
</html>
