<?php
// src/classes/Database.php

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $host = getenv('DB_HOST') ?: 'localhost';
            $db   = getenv('DB_NAME') ?: 'ladestationen';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') ?: 'secret';

            $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
            
            try {
                // PDO mit Fehler-Modus initialisieren
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                // Keine sensiblen Passwörter im Frontend ausgeben
                die("Datenbank-Verbindung fehlgeschlagen: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}