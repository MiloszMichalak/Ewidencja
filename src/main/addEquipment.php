<?php

include '../utils/../../config/Database.php';
$conn = Database::getInstance()->conn;

if (isset($_POST['numerInwentaryzacyjny'])) {
    $numerInwentaryzacyjny = $_POST['numerInwentaryzacyjny'];
    $numerSeryjny = $_POST['numerSeryjny'];
    $urzadzenie = $_POST['urzadzenie'];
    $producent = $_POST['producent'];
    $model = $_POST['model'];
    $lokalizacja = $_POST['lokalizacja'];
    $dostawca = $_POST['dostawca'];
    $dataZakupu = $_POST['dataZakupu'];
    $dataGwarancji = $_POST['dataGwarancji'];
    $dataPrzegladu = $_POST['dataPrzegladu'];
    $wartoscBrutto = $_POST['wartoscBrutto'];
    $status = $_POST['status'];
    $uwagi = $_POST['uwagi'];
    
    $result = $conn->query("SELECT COUNT(*) FROM sprzet_medyczny.sprzety WHERE numerInwentaryzacyjny = '$numerInwentaryzacyjny' OR numerSeryjny = '$numerSeryjny'");
    $row = $result->fetch_array();

    if ($row['COUNT(*)'] > 0) {
        echo "Numer inwentaryzacyjny lub numer seryjny już istnieje.";
        return;
    }
    
    if (strtotime($dataZakupu) > time()) {
        echo "Data zakupu nie moze byc w przyszlosci.";
        return;
    }
    
    if (strtotime($dataGwarancji) < strtotime($dataZakupu) || strtotime($dataPrzegladu) < strtotime($dataZakupu)) {
        echo "Data gwarancji lub data przeglądu nie mogą byc wczesniejsze niz data zakupu.";
        return;
    }
    
//    $zdjecie = null;
//    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
//        $zdjecie = file_get_contents($_FILES['zdjecie']['tmp_name']);
//    }

    $result = $conn->query("INSERT INTO sprzet_medyczny.sprzety (idSprzetu, numerInwentaryzacyjny, numerSeryjny, urzadzenie, producent, model, lokalizacja, dostawca, dataZakupu, dataGwarancji, dataPrzegladu, wartoscBrutto, status, zdjecie, uwagi) 
                             VALUES (null, '$numerInwentaryzacyjny', '$numerSeryjny', $urzadzenie, $producent, '$model', $lokalizacja, $dostawca, '$dataZakupu', '$dataGwarancji', '$dataPrzegladu', $wartoscBrutto, $status, null, '$uwagi')");

    if ($result) {
        echo "success";
    }
}
