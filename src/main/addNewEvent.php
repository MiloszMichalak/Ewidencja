<?php
include_once "../../config/Database.php";
$conn = Database::getInstance()->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataRozpoczecia = isset($_POST['dataRozpoczecia']) ? date('Y-m-d', strtotime($_POST['dataRozpoczecia'])) : null;
    $dataZakonczenia = isset($_POST['dataZakonczenia']) ? date('Y-m-d', strtotime($_POST['dataZakonczenia'])) : null;
    $opisZdarzenia = $_POST['opisZdarzenia'] ?? '';
    $typZdarzenia = $_POST['typZdarzenia'] ?? null;

    if (!$dataRozpoczecia || !$dataZakonczenia || !$typZdarzenia) {
        die("Wszystkie wymagane pola muszą być wypełnione.");
    }

    if (strtotime($dataZakonczenia) < strtotime($dataRozpoczecia)) {
        die('Błąd: Data zakończenia nie może być wcześniejsza niż data rozpoczęcia!');
    }
        
    $zalacznik = null;
    if (isset($_FILES['zalacznik'])) {
        $zalacznik = $_FILES['zalacznik'];
        $tmp_name = $_FILES['zalacznik'];
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($tmp_name, $upload_dir . $zalacznik);
    }
    
    $sql = "INSERT INTO sprzet_medyczny.zdarzenia (idZdarzenia,dataRozpoczecia, dataZakonczenia, opisZdarzenia, zalacznik, idTypu)
            VALUES (null, '$dataRozpoczecia' , '$dataZakonczenia' , '$opisZdarzenia' , null , $typZdarzenia)";
    if ($conn->query($sql)) {
        echo "success";
    } else {
        echo "Wystąpił błąd podczas dodawania zdarzenia.";
    }
}