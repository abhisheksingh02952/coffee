<?php
include 'db.php';


$result = $mysqli->query("SELECT user_id, parent_id, em_name, position, sale  FROM user_db");

$data = [];

while ($row = $result->fetch_assoc()) {

    $data[] = [
        'id' => $row['user_id'],
        'pid' => $row['parent_id'],
        'name' => $row['em_name'],
        'position' => $row['position']
    ];
}

header('Content-Type: application/json');
echo json_encode($data);

?>



