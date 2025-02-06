<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ewidencja sprzetu medycznego</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script defer src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="../resource/config.js"></script>
    
    <script src="../resource/tableDataInjector.js" defer></script>
</head>
<?php
    include "../config/Database.php";
    $conn = Database::getInstance()->conn;
?>
<body>
    <h1>Ewidencja</h1>
    <table id="equipment-table" border="1">
        <thead>
            <tr>
                <th>Numer Inwentaryzacyjny</th>
                <th>Numer Seryjny</th>
                <th>Urządzenie</th>
                <th>Producent</th>
                <th>Model</th>
                <th>Lokalizacja</th>
                <th>Dostawca</th>
                <th>Data Zakupu</th>
                <th>Data Gwarancji</th>
                <th>Data Przeglądu</th>
                <th>Wartość Brutto</th>
                <th>Status</th>
                <th>Uwagi</th>
                <th>Zdarzenie</th>
            </tr>
            <tr>
                <th><input type="text" placeholder="Filtruj..." class="filter" /></th>
                <th><input type="text" placeholder="Filtruj..." class="filter"/></th>
                <th><input type="text" placeholder="Filtruj..." class="filter"/></th>
                <th>
                    <select id='select-filter1'>
                        <option value="">Wszystkie</option>
                        <?php
                            $sql = "SELECT * FROM sprzet_medyczny.producenci";
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_array()) {
                                    echo "<option value='".$row['nazwa']."'>".$row['nazwa']."</option>";
                                }
                            }
                        ?>
                    </select>
                </th>
                <th>
                    <select id="select-models">
                        <option value="">Wszystkie</option>
                        <?php
                            $sql = "SELECT * FROM sprzet_medyczny.sprzety";
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_array()) {
                                    echo "<option value='".$row['model']."'>".$row['model']."</option>";
                                }
                            }
                        ?>
                    </select>
                </th>
                <th>
                    <?php
                        if ($_COOKIE['userRole'] === 'admin'){
                            echo "<select id='select-filter2'>";
                            echo "<option value=''>Wszystkie</option>";
                            $sql = "SELECT * FROM sprzet_medyczny.lokalizacje";
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_array()) {
                                    echo "<option value='".$row['nazwa']."'>".$row['nazwa']."</option>";
                                }
                            }
                        }
                    ?>
                    </select>
                </th>
                <th><input type="text" placeholder="Filtruj..." class="filter"></th>
                <th>
                    <input type="text" id="min-date1" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" /><br>
                    <input type="text" id="max-date1" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" />
                </th>
                <th>
                    <input type="text" id="min-date2" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" /><br>
                    <input type="text" id="max-date2" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" />
                </th>
                <th>
                    <input type="text" id="min-date3" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" /><br>
                    <input type="text" id="max-date3" placeholder="dd-mm-yyyy" class="filterDate" style=" display: inline-block;" />
                </th>
                <th>
                    <input type="number" id="min-price" placeholder="Od" style="width: 45%; display: inline-block;" /><br>
                    <input type="number" id="max-price" placeholder="Do" style="width: 45%; display: inline-block;" />
                </th>
                <th>
                    <select id='select-filter3'>
                        <option value="">Wszystkie</option>
                        <?php
                            $sql = "SELECT * FROM sprzet_medyczny.statusy";
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_array()) {
                                    echo "<option value='".$row['nazwa']."'>".$row['nazwa']."</option>";
                                }
                            }
                        ?>
                    </select>
                </th>
                <th><input type="text" placeholder="Filtruj..." class="filter"/></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>
</html>