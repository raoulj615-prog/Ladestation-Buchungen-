<?php
// src/classes/Database.php

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            // WICHTIG: Host muss 'db' heißen (Name des MariaDB-Services in docker-compose)
            $host = 'db'; 
            $port = '3306';
            $dbname = 'meine_db';          // Aus docker-compose.yml (Zeile 22)
            $user = 'benutzer';            // Aus docker-compose.yml (Zeile 23)
            $pass = 'benutzerpasswort';    // Aus docker-compose.yml (Zeile 24)

            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
            
            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Datenbank-Verbindung fehlgeschlagen: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}