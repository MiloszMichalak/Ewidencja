<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejestrowanie</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <form action="" method="post" id="registerForm">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email">
        <label for="lokalizacja"></label>
        <select name="lokalizacja" id="lokalizacja">
            <?php 
                include_once "../config/Database.php";
                include "../src/utils/utils.php";
            
                $conn = Database::getInstance()->conn;
                
                $sql = "SELECT * FROM sprzet_medyczny.lokalizacje";
                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_array()) {
                        echo "<option value='".$row['idLokalizacji']."'>".$row['nazwa']."</option>";
                    }
                }
            ?>
        </select>
        <br>
        <button type="submit">Zaloguj</button>
        
        <div id="errorMsg" style="color: red"></div>
    </form>
    <a href="login.html">Masz juz konto? Zaloguj sie</a>

</body>
<script src="../resource/formHandler.js"></script>
</html>