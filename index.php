<?php
ob_start();
  // Include db config
  require_once("config/pdoconnect.php");
  require_once("config/sessions.php");

  $userName = '';
  $password = '';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userName = $_POST["userName"];
    $password = $_POST["passw1"];

     // Make sure errors are empty
    if(!empty($userName) && !empty($password)){
      // Prepare query
      $sql = 'SELECT userName, password FROM officerauthentication WHERE userName = :userName';

      // Prepare statement
      if($stmt = $conn->prepare($sql)){
        // Bind params
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);

        // Attempt execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              $databasepassword = $row['password'];
              if($databasepassword == $password){
                // SUCCESSFUL LOGIN
                $_SESSION['userName'] = $userName;
                if($_SESSION['userName'] !== "admin"){
                  header('location: Members');
                }elseif ($_SESSION['userName'] == "admin") {
                  header('location: Admin');
                  $_SESSION["SuccessMessage"] = $_SESSION["userName"];
                  exit;
                }else{
                  echo "Unauthorised user";
                }
                
              } else {
                // Display wrong password message
                $_SESSION["ErrorMessage"] = 'The password you entered is not valid';
                header("Location: index.php");
              exit;
              }
            }
          } else {
            $_SESSION["ErrorMessage"] = 'User not found';
            header("Location: index.php");
            exit;
          }
        } else {
          die('Something went wrong');
        }
      }
      // Close statement
      unset($stmt);
    }
  unset($conn);
}
 ?>



<!DOCTYPE html>
<html>
  <header>
    <title>The Login page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="js/angularjs.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src="js/jquery.min.js"></script>
  </header>
  
<body ng-app="myApp" ng-controller="userCtrl">

<div class="w3-container">
  <?php 
    echo message(); 
    echo SuccessMessage();
   ?>

<h3>User Log In</h3>   

 <form name="myForm" ng-hide="hideform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div ng-show="edit">
      <!-- Input username and password -->
      <label>Username:</label>
      <input class="w3-input w3-border" type="text" name="userName" ng-model="userName" placeholder="User name" required><br>
    </div>

    <div ng-show="edit">
      <label>Password:</label>
      <input class="w3-input w3-border" type="password" name="passw1" ng-model="passw1" placeholder="Password" required>
    </div><br>
    
    <div ng-show="edit">
      <label>Repeat password:</label>
      <input class="w3-input w3-border" type="password" ng-model="passw2" placeholder="Repeat Password">
    </div>
      
    <br>
    <button class="w3-btn w3-green w3-ripple" ng-click="loginUser()" ng-disabled="error || incomplete">&#10004; login</button>
  </form>

</div>

<script src= "js/authentication.js"></script>

</body>
</html>

<?php ob_get_flush(); ?>