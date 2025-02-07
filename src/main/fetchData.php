<?php

include_once "../../config/Database.php";

session_start();
$conn = Database::getInstance()->conn;
$login = $_COOKIE['login'];
$userRole = $_COOKIE['userRole'];

$sql = "SELECT 
    sprzet.idSprzetu,
    sprzet.numerInwentaryzacyjny,
    sprzet.numerSeryjny,
    sprzet.urzadzenie,
    sprzet.producent,
    sprzet.model,
    sprzet.lokalizacja,
    sprzet.dostawca,
    sprzet.dataZakupu,
    sprzet.dataGwarancji,
    sprzet.dataPrzegladu,
    sprzet.wartoscBrutto,
    sprzet.status,
    sprzet.uwagi,
    urzadzenia.nazwa AS urzadzenie_nazwa,
    producent.nazwa AS producent_nazwa,
    lokalizacja.nazwa AS lokalizacja_nazwa,
    dostawca.nazwa AS dostawca_nazwa,
    dostawca.adres as dostawca_adres,
    dostawca.telefon as dostawca_telefon,
    dostawca.email as dostawca_email,
    status.nazwa AS status_nazwa,
    GROUP_CONCAT(
        CONCAT(
            IFNULL(zdarzenie.opisZdarzenia, 'Brak opisu zdarzenia'), '<br>',
            IFNULL(zdarzenie.dataRozpoczecia, 'Brak daty rozpoczęcia') , ' - ', 
            IFNULL(zdarzenie.dataZakonczenia, 'Brak daty zakończenia'), '<br>',
            IFNULL(typyZdarzen.nazwa, 'Brak typu zdarzenia'), '<br>',
            IFNULL(zdarzenie.zalacznik, 'Brak załącznika')
        ) SEPARATOR '<br><hr>' 
    ) AS zdarzenie_opisZdarzenia
FROM sprzet_medyczny.sprzety sprzet
LEFT JOIN sprzet_medyczny.urzadzenia urzadzenia ON sprzet.urzadzenie = urzadzenia.idUrzadzenia
LEFT JOIN sprzet_medyczny.producenci producent ON sprzet.producent = producent.idProducenta
LEFT JOIN sprzet_medyczny.lokalizacje lokalizacja ON sprzet.lokalizacja = lokalizacja.idLokalizacji
LEFT JOIN sprzet_medyczny.dostawcy dostawca ON sprzet.dostawca = dostawca.idDostawcy
LEFT JOIN sprzet_medyczny.statusy status ON sprzet.status = status.idStatusu
LEFT JOIN sprzet_medyczny.zdarzenie_sprzet zs ON sprzet.idSprzetu = zs.sprzet_id
LEFT JOIN sprzet_medyczny.zdarzenia zdarzenie ON zs.zdarzenie_id = zdarzenie.idZdarzenia
LEFT JOIN sprzet_medyczny.typy_zdarzen typyZdarzen ON zdarzenie.idTypu = typyZdarzen.idTypu";


if ($userRole == 'user'){
    $sql .= " where idLokalizacji = (
    SELECT sprzet_medyczny.uzytkownicy.idLokalizacji from sprzet_medyczny.uzytkownicy where login = '$login'
    )";
}

$sql .= " GROUP BY sprzet.idSprzetu;";

$data = [];
if ($query = $conn->query($sql)) {
    while ($result = $query->fetch_array()) {
        $data[] = $result;
    }

    echo json_encode($data);
}