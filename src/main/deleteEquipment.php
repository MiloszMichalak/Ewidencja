<?php
include "../../config/Database.php";
$conn = Database::getInstance()->conn;

if (isset($_POST['id'])){
    $id = intval($_POST['id']);
    $result = $conn->query("DELETE FROM sprzet_medyczny.sprzety WHERE idSprzetu = $id");
    
    if ($result) {
        echo "success";
    }
}
