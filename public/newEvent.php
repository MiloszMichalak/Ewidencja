<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dodawanie nowego zdarzenia</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script defer src="../resource/config.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script defer src="../resource/newEventHandler.js"></script>
</head>
<body>
    <form method="post" action="" id="addEventForm" enctype="multipart/form-data">
        <label for="typZdarzenia">Typ zdarzenia</label>
        <select name="typZdarzenia" id="typZdarzenia">
            <?php
                include_once "../config/Database.php";
                $conn = Database::getInstance()->conn;
                $sql = "SELECT * FROM sprzet_medyczny.typy_zdarzen";
                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_array()) {
                        echo "<option value='".$row['idTypu']."'>".$row['nazwa']."</option>";
                    }
                }
            ?>
        </select>
        <label for="dataRozpoczecia">Data rozpoczęcia</label>
        <input type="text" name="dataRozpoczecia" id="dataRozpoczecia" class="filterDate">
        
        <label for="dataZakonczenia">Data zakończenia</label>
        <input type="text" name="dataZakonczenia" id="dataZakonczenia" class="filterDate">
        
        <label for="opisZdarzenia">Opis zdarzenia</label>
        <textarea name="opisZdarzenia" id="opisZdarzenia"></textarea>
        
        <label for="zalacznik">Załącznik</label>
        <input type="file" name="zalacznik" id="zalacznik">
        
        <button type="submit">Dodaj</button>
    </form>
    
    <div id="errorMsg"></div>

</body>
</html>