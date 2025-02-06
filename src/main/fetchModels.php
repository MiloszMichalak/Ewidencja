<?php
include_once "../../config/Database.php";
$conn = Database::getInstance()->conn;
$models = [];

$sql = "SELECT * FROM sprzet_medyczny.sprzety";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_array()) {
        $models[] = $row['model'];
    }
    echo json_encode($models);
}
