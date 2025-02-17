<?php
include_once "../../config/Database.php";

$conn = Database::getInstance()->conn;

if (isset($_GET['name'])) {
    $nameProducenta = $_GET['name'];
    $sql = "SELECT model FROM sprzet_medyczny.sprzety WHERE producent = (
        SELECT idProducenta FROM sprzet_medyczny.producenci WHERE nazwa = '$nameProducenta'
    ) GROUP BY 1";

    $result = $conn->query($sql);
    $data = [];
    
    if($result && $result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $data[] = $row['model'];
        }
    }

    echo json_encode($data);
}

