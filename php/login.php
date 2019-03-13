<?php
$data = json_decode(file_get_contents("php://input"));

require_once ("../config/pdoconnect.php");

$stmt = $conn->prepare('SELECT * FROM officerauthentication WHERE userName=? AND password=?');
$stmt->execute(array($data->userName, $data->userPassword));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row > 0)
{
    $response = [
        "success" => true
    ];

    echo json_encode($response);
}
else
{
    $response = [
        "success" => false
    ];

    echo json_encode($response);
}
?>