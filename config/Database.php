<?php

require_once 'config.php';

class Database
{
    private static ?Database $instance = null;
    public mysqli $conn;
    
    private function __construct()
    {
        try {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        } catch (Exception $e) {
            die("Blad polaczenia: " . $e->getMessage());
        }
    }
    
    public static function getInstance(): ?Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function __destruct()
    {
        $this->conn->close();
    }
}