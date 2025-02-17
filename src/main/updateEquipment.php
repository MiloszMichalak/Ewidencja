<?php
include '../../config/Database.php';
$conn = Database::getInstance()->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSprzetu = $_POST['idSprzetu'];
    $dataPrzegladu = $_POST['dataPrzegladu'];
    $wartoscBrutto = $_POST['wartoscBrutto'];
    $lokalizacja = $_POST['lokalizacja'];
    $status = $_POST['status'];
    $uwagi = $_POST['uwagi'];
    $zdarzenia = $_POST['zdarzenia'] ?? [];
    
    $sqlSprzet = "UPDATE sprzet_medyczny.sprzety 
                  SET dataPrzegladu = '$dataPrzegladu', wartoscBrutto = $wartoscBrutto, lokalizacja = '$lokalizacja', status = '$status', uwagi = '$uwagi'
                  WHERE idSprzetu = '$idSprzetu'";
    $conn->query($sqlSprzet);
    
    $sqlDeleteZdarzenia = "DELETE FROM sprzet_medyczny.zdarzenie_sprzet WHERE sprzet_id = $idSprzetu";
    $conn->query($sqlDeleteZdarzenia);
    
    foreach ($zdarzenia as $zdarzenie_id) {
        $sqlInsertZdarzenia = "INSERT INTO sprzet_medyczny.zdarzenie_sprzet (sprzet_id, zdarzenie_id) VALUES ('$idSprzetu', '$zdarzenie_id')";
        $conn->query($sqlInsertZdarzenia);
    }
    echo "Success";
} else {
    echo "Update sie nie powiódł.";
}

