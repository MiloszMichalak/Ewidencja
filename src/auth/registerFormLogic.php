<?php
include "../../config/Database.php";
include "../utils/utils.php";

$conn = Database::getInstance()->conn;

if (isset($_POST['lokalizacja'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $localization = $_POST['lokalizacja'];

    $sql = "SELECT * FROM sprzet_medyczny.uzytkownicy WHERE login = '$login'";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO sprzet_medyczny.uzytkownicy (idUzytkownika, login, haslo, email, idLokalizacji) 
                    VALUES (null, '$login', '$hashedPassword', '$email', '$localization')";

            if ($conn->query($sql)) {
                echo saveCookie($login);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Uzytkownik o takim loginie juz istnieje";
        }
    } else {
        echo "Error: " . "<br>" . $conn->error;
    }
}
