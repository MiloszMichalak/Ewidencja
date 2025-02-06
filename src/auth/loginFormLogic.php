<?php
include_once "../../config/Database.php";
include "../utils/utils.php";
$conn = Database::getInstance()->conn;

if (isset($_POST['login'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM sprzet_medyczny.uzytkownicy WHERE login = '$login'";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        if ($result->num_rows == 1 && password_verify($password, $row["haslo"])) {
            saveCookie($login);
            echo "success";
        } else {
            echo "Niepoprawne dane logowania";
        }
    } else {
        echo "Error: " . "<br>" . $conn->error;
    }
}