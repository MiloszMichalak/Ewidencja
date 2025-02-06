<?php

session_start();
if (isset($_COOKIE['login'])) {
    header("Location: main.php");
} else {
    header("Location: login.html");
}





