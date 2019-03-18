<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");

$result = $conn->query("SELECT userName,dutyDate,morningDuty,morningVenue,afternoonDuty,afternoonVenue,morningStatus,afternoonStatus,comment FROM rotausersduty");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"userName":"'  . $rs["morningVenue"] . '",';
    $outp .= '"dutyDate":"'   . $rs["dutyDate"]        . '",';
    $outp .= '"morningDuty":"'. $rs["morningDuty"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>