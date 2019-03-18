<!DOCTYPE html>  
<html>
<title>ROTA Members Index Page</title>
  <?php 
  include('../links/simple_html_dom.php');
  echo file_get_html('../links/htmllinks.html');
  require_once("../config/sessions.php");
  require_once("memberauthentication.php");
 ?>

<body ng-app="myApp" ng-controller="membersCtrl">

<div class="w3-container">
  <?php 
    echo message();
    echo SuccessMessage();
   ?>

<h3>User: <?php echo $_SESSION["userName"]; ?></h3>
<div>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"  >
      <h3><b>Morning</b></h3>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <h3><b>Afternoon</b></h3>
    </div>
  </div>
</div>

<table class="w3-table w3-bordered w3-striped">
  <tr>
    <th></th>
    <th>Date</th>
    <th>Duty</th>
    <th style="border-right: 5px solid black">Venue</th>
    <th>Duty</th>
    <th>Venue</th>
  </tr>
  <?php 
      $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");
      $userName = $_SESSION["userName"];
      $sql = "SELECT * FROM rotausersduty WHERE userName = '$userName' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          while($datarows = $result->fetch_assoc()){ ?>
  <tr>
    <td>
      <button class="w3-btn w3-ripple" ng-click="editUser(user.id)">&#9998; Numbering</button>
    </td>
    <td><?php echo $datarows["dutyDate"]; ?></td>
    <td><?php echo $datarows["morningDuty"]; ?></td>
    <td style="border-right: 5px solid black"><?php echo $datarows["morningVenue"]; ?></td>
    <td><?php echo $datarows["afternoonDuty"]; ?></td>
    <td><?php echo $datarows["afternoonVenue"]; ?></td>
</tr>
         <?php }
        }
     ?>
    
  
</table>
<br>
<button class="w3-btn w3-green w3-ripple" ng-hide="edit" ng-click="newRecord()">&#9998; Create New record</button>

<form ng-hide="hideform" method="POST" action="toDatabase.php">
  <h2 ng-show="edit"><b>New Record:</b></h2>
  <!-- <h3 ng-hide="edit">Edit User:</h3>-->
  <br>
    <label>Date:</label>
    <input class="w3-input w3-border" type="Date" ng-model="Date" name="Date" required>
    <span style="color:red" ng-show="myForm.Date.$invalid">
      <span ng-show="myForm.Date.$error.required">Date is required.</span>
    </span>
  <br>
  <!--Morning shift-->
  <h3><b>Morning</b></h3>
    <label>Duty:</label>
    <input class="w3-input w3-border" type="text" ng-model="morningDuty" name="morningDuty" placeholder="Morning Duty" required >
    <span style="color:red" ng-show="myForm.morningDuty.$invalid">
      <span ng-show="myForm.morningDuty.$error.required">Morning duty is required.</span>
    </span>
  <br>
    <label>Venue:</label>
    <input class="w3-input w3-border" type="text" ng-model="morningVenue"  name="morningVenue" placeholder="Morning venue" required >
    <span style="color:red" ng-show="myForm.morningVenue.$invalid">
      <span ng-show="myForm.morningVenue.$error.required">Morning duty is required.</span>
    </span>
  <br>
  <!--Afternoon shift-->
  <h3><b>Afternoon</b></h3>

    <label>Duty:</label>
    <input class="w3-input w3-border" type="text" ng-model="afternoonDuty"  name="afternoonDuty" placeholder="Afternoon duty" required >
    <span style="color:red" ng-show="myForm.afternoonDuty.$invalid">
      <span ng-show="myForm.afternoonDuty.$error.required">Afternoon duty is required.</span>
    </span>
  <br>
    <label>Venue:</label>
    <input class="w3-input w3-border" type="text" ng-model="afternoonVenue"  name="afternoonVenue" placeholder="Afternoon venue" required>
    <span style="color:red" ng-show="myForm.afternoonVenue.$invalid">
      <span ng-show="myForm.afternoonVenue.$error.required">Date is required.</span>
    </span>
  <br>

  <label>Comments:</label>
    <textarea class="w3-input w3-border" type="text" ng-model="comment" placeholder="Enter your comment here" name="comment" ></textarea>
  <br>

  <button type="submit" class="w3-btn w3-green w3-ripple" ng-click=validate()>&#10004; Save Changes</button>
</form>

</div>

<script src= "../js/members.js"></script>

</body>
</html>
