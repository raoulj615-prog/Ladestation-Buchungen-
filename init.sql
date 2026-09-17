CREATE DATABASE IF NOT EXISTS meine_db;

USE meine_db;

CREATE TABLE IF NOT EXISTS stations (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    power_kw INT NOT NULL,

    type VARCHAR(50) NOT NULL,

    price_kwh DECIMAL(5,2) NOT NULL

);

CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    address VARCHAR(255) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS bookings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NULL,

    station_id INT NOT NULL,

    license_plate VARCHAR(20) NOT NULL,

    start_time DATETIME NOT NULL,

    duration_hours INT NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,

    FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE

);

INSERT INTO stations (name, power_kw, type, price_kwh) VALUES

('Säule 1 - Friedberg Süd', 11, 'Typ 2 AC', 0.45),

('Säule 2 - Campus Friedberg', 22, 'Typ 2 AC', 0.49),

('Säule 3 - Schnelllader A5', 150, 'CCS DC', 0.69);