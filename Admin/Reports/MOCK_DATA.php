<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");

$result = $conn->query("SELECT * FROM rotausersduty");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"userName":"'  . $rs["userName"] . '",';
  $outp .= '"morningDuty":"'   . $rs["morningDuty"] . '",';
  $outp .= '"morningVenue":"'. $rs["morningVenue"]     . '"}';
  $outp .= '"afternoonDuty":"'. $rs["afternoonDuty"]     . '"}';
  $outp .= '"afternoonVenue":"'. $rs["afternoonVenue"]     . '"}';
  $outp .= '"comment":"'. $rs["comment"]     . '"}';
}
$outp ='['.$outp.']';
echo($outp);
$conn->close();


?>