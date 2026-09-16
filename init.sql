CREATE DATABASE IF NOT EXISTS meine_db;
USE meine_db;

CREATE TABLE IF NOT EXISTS stations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    power_kw INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    price_kwh DECIMAL(5,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    station_id INT NOT NULL,
    license_plate VARCHAR(20) NOT NULL,
    start_time DATETIME NOT NULL,
    duration_hours INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE
);

INSERT INTO stations (name, power_kw, type, price_kwh) VALUES
('Säule 1 - Friedberg Süd', 11, 'Typ 2 AC', 0.45),
('Säule 2 - Campus Friedberg', 22, 'Typ 2 AC', 0.49),
('Säule 3 - Schnelllader A5', 150, 'CCS DC', 0.69);