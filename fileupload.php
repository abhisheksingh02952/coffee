<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();
include 'db.php';

if (isset($_FILES['excelFile']['name'])) {
    $file = $_FILES['excelFile']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    $rowCount = 0;

    // Skip header row
    for ($i = 1; $i < count($data); $i++) {
        $name = $conn->real_escape_string($data[$i][0]);
        $fathername = $conn->real_escape_string($data[$i][1]);
        $gst = $conn->real_escape_string($data[$i][2]);
        $phone = $conn->real_escape_string($data[$i][3]);
        $address = $conn->real_escape_string($data[$i][4]);
        $pin = $conn->real_escape_string($data[$i][5]);
        $area = $conn->real_escape_string($data[$i][6]);
        $scheme = $conn->real_escape_string($data[$i][7]);
        $reporting_id = $conn->real_escape_string($data[$i][8]);

        // ✅ Correct column names and values
        $sql = "INSERT INTO shop (name, fathername, gst, phone, address, pin, area, scheme, reporting_id)
                VALUES ('$name', '$fathername', '$gst', '$phone', '$address', '$pin', '$area', '$scheme', '$reporting_id')";

        if ($conn->query($sql)) {
            $rowCount++;
        } else {
            // Log the error for debugging (optional)
            error_log("Insert failed: " . $conn->error);
        }
    }

    echo "$rowCount records inserted successfully.";
} else {
    echo "No file uploaded.";
}
?>
