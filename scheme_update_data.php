<?php
include 'db.php';

if (isset($_POST['shop_id']) && isset($_POST['scheme'])) {
    $shop_id = mysqli_real_escape_string($conn, $_POST['shop_id']);
    $scheme = mysqli_real_escape_string($conn, $_POST['scheme']);

    // Perform the update
    $updateQuery = "UPDATE shop SET scheme = '$scheme' WHERE shop_id = '$shop_id'";
    if (mysqli_query($conn, $updateQuery)) {
        // Fetch the updated data
        $selectQuery = "SELECT shop_id, scheme FROM shop WHERE shop_id = '$shop_id' LIMIT 1";
        $result = mysqli_query($conn, $selectQuery);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Record not found"]);
        }
    } else {
        echo json_encode(["error" => "Update failed"]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}

mysqli_close($conn);
?>
