<?php
include_once "../config/Database.php";

if (isset($_GET['id'])){
    $idSprzetu = $_GET['id'];
    echo "<script>localStorage.setItem('id', '$idSprzetu')</script>";
    $conn = Database::getInstance()->conn;
    
    $sql = "SELECT 
                sprzet.lokalizacja,
                sprzet.dataPrzegladu,
                sprzet.wartoscBrutto,
                sprzet.status,
                sprzet.uwagi,
                lokalizacja.nazwa AS lokalizacja_nazwa,
                status.nazwa AS status_nazwa,
                zdarzenie.dataRozpoczecia as zdarzenie_dataRozpoczecia,
                zdarzenie.dataZakonczenia as zdarzenie_dataZakonczenia,
                zdarzenie.opisZdarzenia as zdarzenie_opisZdarzenia,
                zdarzenie.zalacznik as zdarzenie_zalacznik
            FROM sprzet_medyczny.sprzety sprzet
            LEFT JOIN sprzet_medyczny.lokalizacje lokalizacja ON sprzet.lokalizacja = lokalizacja.idLokalizacji
            LEFT JOIN sprzet_medyczny.statusy status ON sprzet.status = status.idStatusu
            left join sprzet_medyczny.zdarzenie_sprzet zs on sprzet.idSprzetu = zs.sprzet_id
            left join sprzet_medyczny.zdarzenia zdarzenie on zs.zdarzenie_id = zdarzenie.idZdarzenia
            left join sprzet_medyczny.typy_zdarzen typyZdarzen on typyZdarzen.idTypu = zdarzenie.idTypu
            WHERE sprzet.idSprzetu = '$idSprzetu';";

    $result = $conn->query($sql);
    $data = $result->fetch_array();

    if ($data) {
        $lokalizacja = $data['lokalizacja'];
        $dataPrzegladu = $data['dataPrzegladu'];
        $wartoscBrutto = $data['wartoscBrutto'];
        $status = $data['status'];
        $uwagi = $data['uwagi'];
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
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/editStyle.css">
    <script defer src="../resource/config.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script defer src="../resource/updateEquipmentHandler.js"></script>
</head>
<body>
    <form id="editForm">
        <h1>Edytuj sprzęt</h1>
        <input type="hidden" name="idSprzetu" value="<?php echo $idSprzetu; ?>">
        
        <label for="dataPrzegladu">Data przegladu</label>
        <input id="dataPrzegladu" type="text" class="filterDate" value="<?php echo $dataPrzegladu; ?>">
        
        <label for="wartoscBrutto">Wartość Brutto</label>
        <input id="wartoscBrutto" type="text" value="<?php echo $wartoscBrutto; ?>">
        
        <label for="lokalizacja">Lokalizacja</label>
        <select id="lokalizacja">
            <?php
                $sql = "SELECT * FROM sprzet_medyczny.lokalizacje";
                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_array()) {
                        echo "<option value='".$row['idLokalizacji']."' ".($lokalizacja == $row['idLokalizacji'] ? "selected" : "").">".$row['nazwa']."</option>";
                    }
                }
            ?>
        </select>
        
        <label for="status">Status</label>
        <select id="status">
            <?php
            $sql = "SELECT * FROM sprzet_medyczny.statusy";
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_array()) {
                    echo "<option value='".$row['idStatusu']."' ".($status == $row['idStatusu'] ? "selected" : "").">".$row['nazwa']."</option>";
                }
            }
            ?>
        </select>
        
        <label for="uwagi">Uwagi</label>
        <textarea id="uwagi"><?php echo $uwagi ?></textarea>
        
        <div id="zdarzenia">
            <p>Zdarzenia:</p>
                <?php
                    $sqlZdarzeniaPrzypisane = "SELECT DISTINCT 
                            zdarzenia.idZdarzenia,
                            zdarzenia.opisZdarzenia,
                            typy_zdarzen.nazwa
                            FROM sprzet_medyczny.zdarzenia 
                            JOIN sprzet_medyczny.typy_zdarzen 
                            ON zdarzenia.idTypu = typy_zdarzen.idTypu
                            join sprzet_medyczny.zdarzenie_sprzet zs 
                            on zdarzenia.idZdarzenia = zs.zdarzenie_id
                            WHERE zs.sprzet_id = $idSprzetu";
                
                    $sqlWszystkieZdarzenia = "SELECT 
                        zdarzenia.idZdarzenia, 
                        zdarzenia.opisZdarzenia, 
                        typy_zdarzen.nazwa 
                        FROM 
                            sprzet_medyczny.zdarzenia 
                        INNER JOIN 
                            sprzet_medyczny.typy_zdarzen 
                        ON 
                            zdarzenia.idTypu = typy_zdarzen.idTypu";
                    $przypisane = [];
                    if ($result = $conn->query($sqlZdarzeniaPrzypisane)) {
                        while ($row = $result->fetch_array()) {
                            $przypisane[] = $row['idZdarzenia'];
                        }
                    }

                    if ($result = $conn->query($sqlWszystkieZdarzenia)) {
                        while ($row = $result->fetch_array()) {
                            $checked = in_array($row['idZdarzenia'], $przypisane) ? "checked" : "";
                            echo "<div>
                            <input type='checkbox' name='zdarzenia' value='".$row['idZdarzenia']."' $checked>
                            ".$row['opisZdarzenia']." (".$row['nazwa'].")
                          </div>";
                        }
                    }
                ?>
        </div>
        

        <input type="submit" value="Zapisz zmiany">
        <a href="newEvent.php">Dodaj nowe zdarzenie</a>
    </form>
</body>
</html>
