<?php
include 'db.php';


function getEmployees($parent_id = NULL, $conn) {
    $data = [];
    $sql = "SELECT * FROM employees WHERE parent_id " . 
           (is_null($parent_id) ? "IS NULL" : "= $parent_id") ;
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        $children = getEmployees($row['id'], $conn);
        if ($children) {
            $row['children'] = $children;
        }
        $data[] = $row;
    }
    return $data;
}

header('Content-Type: application/json');
echo json_encode(getEmployees(NULL, $conn));
?>
