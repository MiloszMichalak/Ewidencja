<?php
include_once "../config/Database.php";

if (isset($_GET['id'])){
    $idSprzetu = $_GET['id'];
    $conn = Database::getInstance()->conn;
    
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
                urzadzenia.nazwa AS urzadzenie_nazwa,
                producent.nazwa AS producent_nazwa,
                lokalizacja.nazwa AS lokalizacja_nazwa,
                dostawca.nazwa AS dostawca_nazwa,
                dostawca.adres as dostawca_adres,
                dostawca.telefon as dostawca_telefon,
                dostawca.email as dostawca_email,
                status.nazwa AS status_nazwa,
                zdarzenie.dataRozpoczecia as zdarzenie_dataRozpoczecia,
                zdarzenie.dataZakoczenia as zdarzenie_dataZakonczenia,
                zdarzenie.opisZdarzenia as zdarzenie_opisZdarzenia,
                zdarzenie.zalacznik as zdarzenie_zalacznik
            FROM sprzet_medyczny.sprzety sprzet
            LEFT JOIN sprzet_medyczny.urzadzenia urzadzenia ON sprzet.urzadzenie = urzadzenia.idUrzadzenia
            LEFT JOIN sprzet_medyczny.producenci producent ON sprzet.producent = producent.idProducenta
            LEFT JOIN sprzet_medyczny.lokalizacje lokalizacja ON sprzet.lokalizacja = lokalizacja.idLokalizacji
            LEFT JOIN sprzet_medyczny.dostawcy dostawca ON sprzet.dostawca = dostawca.idDostawcy
            LEFT JOIN sprzet_medyczny.statusy status ON sprzet.status = status.idStatusu
            left join sprzet_medyczny.zdarzenia zdarzenie on zdarzenie.idZdarzenia = sprzet.zdarzenie
            WHERE sprzet.idSprzetu = '$idSprzetu'";
    
    
    $result = $conn->query($sql);
    $data = $result->fetch_array();

    if ($data) {
        // Wartości formularza
        $numerInwentaryzacyjny = $data['numerInwentaryzacyjny'];
        $numerSeryjny = $data['numerSeryjny'];
        $urzadzenie = $data['urzadzenie'];
        $producent = $data['producent'];
        $model = $data['model'];
        $lokalizacja = $data['lokalizacja'];
        $dostawca = $data['dostawca'];
        $dataZakupu = $data['dataZakupu'];
        $dataGwarancji = $data['dataGwarancji'];
        $dataPrzegladu = $data['dataPrzegladu'];
        $wartoscBrutto = $data['wartoscBrutto'];
        $status = $data['status'];
    } else {
        echo "Sprzęt nie znaleziony.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>edit</title>
    <script src="../resource/config.js"></script>
</head>
<body>
<form id="editForm">
    <input type="hidden" name="idSprzetu" value="<?php echo $idSprzetu; ?>">

    <label for="numerInwentaryzacyjny">Numer Inwentaryzacyjny</label>
    <input type="text" id="numerInwentaryzacyjny" name="numerInwentaryzacyjny" value="<?php echo $numerInwentaryzacyjny; ?>">
    
    <label for="dataZakupu">Urządzenie</label>
    <input id="dataZakupu" type="text" class="filterDate" value="<?php echo $dataZakupu; ?>"> 

    <label for="numerSeryjny">Numer Seryjny</label>
    <input type="text" id="numerSeryjny" name="numerSeryjny" value="<?php echo $numerSeryjny; ?>">

    <input type="submit" value="Zapisz zmiany">
</form>
</body>
</html>
