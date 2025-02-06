<?php
function showAlert($message): void
{
    echo "<script>
            alert('$message');
          </script>";
}

function saveCookie($login): void
{
    include_once "../../config/Database.php";
    $conn = Database::getInstance()->conn;
    
    $sql = "SELECT sprzet_medyczny.uzytkownicy.grupa_uzytkownika FROM sprzet_medyczny.uzytkownicy WHERE login = '$login'";
    $userRole = $conn->query($sql)->fetch_array()['grupa_uzytkownika'];
    
    setcookie("login", $login, time() + (86400 * 30), "/");
    setcookie("userRole", $userRole, time() + (86400 * 30), "/");
}
