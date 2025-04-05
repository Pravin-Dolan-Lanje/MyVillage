<?php  
require_once '../Admin/auth_check.php';
?>
<?php
include '../db_config.php';
header('Content-Type: application/json');

$query = "SELECT * FROM events";
$result = mysqli_query($conn, $query);

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

echo json_encode($events);
?>
