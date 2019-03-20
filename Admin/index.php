<!DOCTYPE html> 
<html>
<head>
  <title>ROTA Admin Index Page</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php 
ob_start();
  include('../links/simple_html_dom.php');
  echo file_get_html('../links/htmllinks.html');
  require_once("../config/sessions.php");
  require_once("statusControl.php");

  if($_SESSION["userName"] !== "admin"){
    header('location: ../../index.php');
     $_SESSION["ErrorMessage"] = "Please login to access admin";
    exit;
    }
 ?>

 <script>
  //Search filter
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
    //HTTP requests for user Data
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

  <!--Dropdown for Pagination-->
  <div class="row">
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
    <table class="w3-table w3-bordered w3-striped" id="mytable">
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
      $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");
      $sql = "SELECT * FROM rotausersduty";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          while($datarows = $result->fetch_assoc()){ ?>

      <tbody id="myTable">      
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
    <!--For purposes of pagination-->
    <div class="pagination-container">
      <nav>
        <ul class="pagination"></ul>
      </nav>
    </div>

    <!--Print Form and Log out buttons-->
    <div class="row" style="margin-top: 20px">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <!--Button for printing reports-->
        <button class="w3-btn w3-green w3-ripple" style="margin:10px; text-align: center;"><a href="Reports/adminReport.php" style="text-decoration: none; color: white">&#9998; Print Report</a></button>

      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <!--Logout button-->
        <button class="w3-btn w3-green w3-ripple" style="margin:10px; text-align: center;"><a href="logout.php?userName=<?php echo $_SESSION['userName']; ?>" style="text-decoration: none; color: white">Logout</a>

      </div>
    </div>   
    
  
  <br>
  

</div>

<script src= "../js/admin.js"></script>
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