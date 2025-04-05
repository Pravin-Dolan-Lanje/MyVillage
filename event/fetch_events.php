<?php  
// require_once '../Admin/auth_check.php';
?>
<?php
include '../db_config.php';

$query = "SELECT * FROM events ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$events = array();

while ($row = mysqli_fetch_assoc($result)) {
    $row['image_url'] = "event/uploads/" . basename($row['image_url']);
    $events[] = $row;
}

// If no events exist, return an empty array
if (empty($events)) {
    echo json_encode([]);
} else {
    echo json_encode($events);
}
?>
