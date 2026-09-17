<?php
// src/classes/StationModel.php
require_once __DIR__ . '/Database.php';

class StationModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Alle Stationen abfragen
    public function getAllStations(): array {
        $stmt = $this->db->query("SELECT * FROM stations");
        return $stmt->fetchAll();
    }

    // Prüfen, ob für eine Station eine Kollision existiert
    public function isStationAvailable(int $stationId, string $startTime, int $durationHours): bool {
        // Berechne Endzeitpunkt der neuen Anfrage
        $sql = "SELECT COUNT(*) FROM bookings 
                WHERE station_id = :station_id 
                AND (
                    (start_time <= :new_start AND DATE_ADD(start_time, INTERVAL duration_hours HOUR) > :new_start)
                    OR
                    (:new_start <= start_time AND DATE_ADD(:new_start, INTERVAL :duration HOUR) > start_time)
                )";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':station_id' => $stationId,
            ':new_start'  => $startTime,
            ':duration'   => $durationHours
        ]);

        return ($stmt->fetchColumn() == 0);
    }

    // Buchung speichern (Prepared Statement gegen SQL Injection)
   public function createBooking(
    int $userId,
    int $stationId,
    string $licensePlate,
    string $startTime,
    int $durationHours
): bool {
    $sql = "INSERT INTO bookings 
            (user_id, station_id, license_plate, start_time, duration_hours) 
            VALUES 
            (:user_id, :station_id, :license_plate, :start_time, :duration)";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':user_id'      => $userId,
        ':station_id'   => $stationId,
        ':license_plate'=> $licensePlate,
        ':start_time'   => $startTime,
        ':duration'     => $durationHours
    ]);
}
    // Alle Buchungen für Übersicht laden
   public function getBookings(int $userId): array {
    $sql = "SELECT b.*, s.name as station_name, s.power_kw 
            FROM bookings b 
            JOIN stations s ON b.station_id = s.id
            WHERE b.user_id = :user_id
            ORDER BY b.start_time DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        ':user_id' => $userId
    ]);

    return $stmt->fetchAll();
}

public function deleteBooking(int $bookingId, int $userId): bool
{
    $sql = "DELETE FROM bookings
            WHERE id = :booking_id
            AND user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':booking_id' => $bookingId,
        ':user_id' => $userId
    ]);
}
}