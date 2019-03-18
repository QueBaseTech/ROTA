<!DOCTYPE html> 
<html>
<head>
  <title>ROTA Admin Index Page</title>
  <?php 
ob_start();
  include('../links/simple_html_dom.php');
  echo file_get_html('../links/htmllinks.html');
  require_once("../config/sessions.php");

  if($_SESSION["userName"] !== "admin"){
  $_SESSION["ErrorMessage"] = "Please login first";
    header('location: ../index.php');
    exit;
    }

 ?>

 <script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
     });
   });
  });
  </script>
  <script>
    function showUser(dateValue) {
        if (dateValue == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
        } else { 
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("displayTable").innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET","processDateChange.php?dateValue="+dateValue,true);
            xmlhttp.send();
        }
    }
  </script>
</head>



<body ng-app="myApp">

<div class="w3-container">
  <div>
    <h3><b>Admin Section</b></h3>
  </div> 

  <div>
    <div class="row">
      <div class="span col-sm-1 col-md-1" style="padding-left: 20px;">
        <span><img src="../img/filter-512.png" width="40px" height="40px"></span>
      </div>
                        
      <div class="myPickDate col-xm-11 col-sm-11 col-md-5 filter-input">
        <div class="input-group">
            <span class="input-group-addon">Date</span>
            <input type="date" id="myPickDate" name="myPickDate" class="calendar calendarMedium fullWidth form-control hasDatepicker" onchange='showUser(this.value)' autocomplete="off">
         </div>
      </div>
      <!-- Filter search BAR -->
      <div class="searchBar col-xm-11 col-sm-11 col-md-5 filter-input" style="margin: 5px; float: right">
        <input id="myInput" type="text" placeholder="Search.."><br><br>
      </div>
        
    </div>
  </div>



  <div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin: 5px; padding:5px">
        
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="margin: 5px; padding:5px" >
        <h3><b>Morning</b></h3>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin: 5px; padding:5px">
        <h3><b>Afternoon</b></h3>
      </div>
    </div>
  </div>

  <div ng-controller="adminCtrl" id="displayTable" class="table-responsive">
    <table class="w3-table w3-bordered w3-striped" >
      <thead>
        <th></th>
        <th>Date</th>
        <th>Name</th>
        <th>Duty</th>
        <th>Venue</th>
        <th style="border-right: 5px solid black">Status</th>
        <th>Duty</th>
        <th>Venue</th>
        <th>status</th>
        <th>Comment</th>
        <th>Sign</th>
      </thead>
        

    <?php 
      $conn = mysqli_connect("localhost", "root", "", "rota");
      $sql = "SELECT * FROM rotausersduty";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          while($datarows = $result->fetch_assoc()){ ?>

      <tbody id="myTable">
        <td>
          <button class="w3-btn w3-ripple" ng-click="editUser(user.id)">
                    
          </button>
        </td>
        <td><?php echo $datarows["dutyDate"]; ?></td>
        <td><?php echo $datarows["userName"]; ?></td>
        <td><?php echo $datarows["morningDuty"]; ?></td>
        <td><?php echo $datarows["morningVenue"]; ?></td>
        <td style="border-right: 5px solid black"><?php echo $datarows["morningStatus"]; ?></td>
        <td><?php echo $datarows["afternoonDuty"]; ?></td>
        <td><?php echo $datarows["afternoonVenue"]; ?></td>
        <td><?php echo $datarows["afternoonStatus"]; ?></td>
        <td><?php echo $datarows["comment"]; ?></td>
        <td></td>
      </tbody>

      <?php }
        }
     ?>

    </table>
  </div>
  <br>
  <button class="w3-btn w3-green w3-ripple" ng-click="">&#9998; Print Report</button>

</div>

<script src= "../js/admin.js"></script>

</body>
</html>

<?php ob_get_flush(); ?>