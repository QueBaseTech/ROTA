<!DOCTYPE html>  
<html>
<head>
  <title>ROTA Members Index Page</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php 
  ob_start();
  include('../links/simple_html_dom.php');
  echo file_get_html('../links/htmllinks.html');
  require_once("../config/sessions.php");
  require_once("memberauthentication.php");
 ?>
 <style>
     a {      
      color: green;
     }
     a:hover {
      color: red;
      font-size: 1.2em;
     }
   </style>
</head>


<body ng-app="myApp" ng-controller="membersCtrl">

<div class="w3-container">
  <?php 
    echo message();
    echo SuccessMessage();
   ?>

<h3>User: <a href="profile.php?userName=<?php echo $_SESSION['userName']; ?>" style="text-decoration: none; "><?php echo $_SESSION["userName"]; ?> </a></h3>

    <!--Selection button for the user to choose max Rows-->
    <div class="form-group">
          <select name="state" id="maxRows" class="form-control" style="width:150px;">
            <option value="5000">Show All</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
          </select>
    </div>
<div>
  
</div>
<table class="w3-table w3-bordered w3-striped" id="mytable"> 
   <!--Morning and Afternoon -->
    <thead>
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
          <th></th>
          <th><h3><b>Morning</b></h3></th>
          <th></th>
          <th></th>        
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  >
          <th><h3><b>Afternoon</b></h3></th>
          <th></th>                
        </div>
      </div>
    </thead>

    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <th>Date</th>
        <th>Duty</th>
        <th style="border-right: 5px solid black">Venue</th>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  >
        <th>Duty</th>
        <th>Venue</th>
      </div>
    </div>

  <?php 
      $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");
      $userName = $_SESSION["userName"];
      $sql = "SELECT * FROM rotausersduty WHERE userName = '$userName' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          while($datarows = $result->fetch_assoc()){ ?>
      <tbody>
        <tr>
          <td><?php echo $datarows["dutyDate"]; ?></td>
          <td><?php echo $datarows["morningDuty"]; ?></td>
          <td style="border-right: 5px solid black"><?php echo $datarows["morningVenue"]; ?></td>
          <td><?php echo $datarows["afternoonDuty"]; ?></td>
          <td><?php echo $datarows["afternoonVenue"]; ?></td>
        </tr>
      </tbody>
      
         <?php }
        }
     ?>
    
  
</table>
<!--For purposes of pagination-->
    <div class="pagination-container">
      <nav>
        <ul class="pagination"></ul>
      </nav>
    </div>
<br>
    
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
  
  <!--My scripts on load-->
  <script src= "../js/members.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    var table = '#mytable';
    $('#maxRows').on('change', function(){
      $('.pagination').html('')
      var trnum = 0;
      var maxRows = parseInt($(this).val())
      var totalRows = $(table+' tbody tr').length
      $(table+' tr:gt(0)').each(function(){
        trnum++
        if(trnum > maxRows){
          $(this).hide()
        }
        if(trnum <= maxRows){
          $(this).show()
        }
      })
      if (totalRows > maxRows) {
        var pagenum = Math.ceil(totalRows/maxRows)
        for(var i=1; i<=pagenum;){
          $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ + '<span class="sr-only">(current)</span></span>\</li>').show()
        }
      }
      $('.pagination li:first-child').addClass('active')
      $('.pagination li').on('click',function(){
        var pageNum = $(this).attr('data-page')
        var trIndex = 0;
        $('.pagination li').removeClass('active')
        $(this).addClass('active')
        $(table+' tr:gt(0)').each(function(){
          trIndex++
          if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)) {
            $(this).hide()
          }else{
            $(this).show()
          }
        })
      })
    })
    $(function(){
      $('table tr:eq(0)').prepend('')
      var id = 0;
      $('table tr:gt(0)').each(function(){
        id++
        $(this).prepend('<td>'+id+'</td>')
      })
    })
  </script>
</body>
</html>

<?php 
  ob_get_flush();
 ?>
