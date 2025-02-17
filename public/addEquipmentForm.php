<!DOCTYPE html>
<html lang="pl">
<?php 
    include "../config/Database.php";
    $conn = Database::getInstance()->conn;
?>
<head>
    <meta charset="UTF-8">
    <title>Dodaj sprzęt</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script defer src="../resource/addEquipmentHandler.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<h2>Dodaj sprzęt</h2>
<form method="post" id="add-equipment-form" enctype="multipart/form-data">
    Numer Inwentaryzacyjny: <input type="text" name="numerInwentaryzacyjny" required><br>
    Numer Seryjny: <input type="text" name="numerSeryjny" required><br>

    Urządzenie:
    <select name="urzadzenie" required>
        <?php 
            $query = "SELECT * FROM sprzet_medyczny.urzadzenia";
            $result = $conn->query($query);
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idUrzadzenia'] . '">' . $row['nazwa'] . '</option>';
            } ?>
    </select><br>

    Producent:
    <select name="producent" required>
        <?php
            $query = "SELECT * FROM sprzet_medyczny.producenci";
            $result = $conn->query($query);
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idProducenta'] . '">' . $row['nazwa'] . '</option>';
            }
        ?>
    </select><br>

    Model: <input type="text" name="model" required><br>

    Lokalizacja:
    <select name="lokalizacja" required>
        <?php
            $query = "SELECT * FROM sprzet_medyczny.lokalizacje";
            $result = $conn->query($query);
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idLokalizacji'] . '">' . $row['nazwa'] . '</option>';
            }
        ?>
    </select><br>

    Dostawca:
    <select name="dostawca" required>
        <?php 
            $query = "SELECT * FROM sprzet_medyczny.dostawcy";
            $result = $conn->query($query);
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idDostawcy'] . '">' . $row['nazwa'] . '</option>';
            }
        ?>
    </select><br>

    Data Zakupu: <input type="date" name="dataZakupu" required><br>
    Data Gwarancji: <input type="date" name="dataGwarancji" required><br>
    Data Przeglądu: <input type="date" name="dataPrzegladu" required><br>

    Wartość Brutto: <input type="number" step="0.01" name="wartoscBrutto" required><br>

    Status:
    <select name="status" required>
        <?php 
            $query = "SELECT * FROM sprzet_medyczny.statusy";
            $result = $conn->query($query);
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idStatusu'] . '">' . $row['nazwa'] . '</option>';
            }
        ?>
    </select><br>

    Zdjęcie: <input type="file" name="zdjecie"><br>
    Uwagi: <input type="text" name="uwagi"><br>

    <input type="submit" name="submit" value="Dodaj sprzęt">
</form>

<div id="errorMsg"></div>

</body>
</html>
