<?php $conn = mysqli_connect("localhost", "root", "", "rota"); 
 require_once("../config/sessions.php");
?>
<!DOCTYPE html>
<html>
<head>
 <?php
    include('../links/simple_html_dom.php');
    echo file_get_html('../links/htmllinks.html');
  ?>
</head>

<body>

<?php
$dateValue = $_GET['dateValue'];
if (!$conn) {
    die('Could not connect: ' . mysqli_error($con));
} 

//check for Members on a give date

$sql="SELECT * FROM rotausersduty WHERE dutyDate = '$dateValue'";
$result = mysqli_query($conn,$sql);

echo "<div ng-controller=\"adminCtrl\"  class=\"table-responsive\"> 
		<table class=\"w3-table w3-bordered w3-striped\" >
			<thead>
				<th></th>
                <th>Date</th>
                <th>Name</th>
                <th>Duty</th>
                <th>Venue</th>
                <th style=\"border-right: 5px solid black\">Status</th>
                <th>Duty</th>
                <th>Venue</th>
                <th>status</th>
                <th>Comment</th>
                <th>Sign</th>
			</thead>";
while($row = mysqli_fetch_array($result)) {
    echo "<tbody id=\"myTable\"> <tr>";  
	echo "<td>" . "</td>";
    echo "<td>" . $row['dutyDate'] . "</td>";
    echo "<td>" . $row['userName'] . "</td>";
    echo "<td>" . $row['morningDuty'] . "</td>";
    echo "<td>" . $row['morningVenue'] ."</td>";
    echo "<td>" . $row['morningStatus'] ."</td>";
    echo "<td>" . $row['afternoonDuty'] ."</td>";
    echo "<td>" . $row['afternoonVenue'] ."</td>";
    echo "<td>" . $row['afternoonStatus'] ."</td>";
    echo "<td>" . $row['comment'] ."</td>";
    echo "<td>"."</td>";

    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
echo "</div>";
mysqli_close($conn);
?>
</body>
</html>

                            