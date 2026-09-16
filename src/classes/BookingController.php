<?php
// src/classes/BookingController.php
require_once __DIR__ . '/StationModel.php';

class BookingController {
    private StationModel $model;

    public function __construct() {
        $this->model = new StationModel();
    }

    public function getStations(): array {
        return $this->model->getAllStations();
    }

    public function getBookings(): array {
        return $this->model->getBookings();
    }

    // Verarbeitet die Buchungsanfrage
    public function processBooking(array $data): array {
        $stationId    = intval($data['station_id'] ?? 0);
        $licensePlate = trim($data['license_plate'] ?? '');
        $startTime    = $data['start_time'] ?? '';
        $duration     = intval($data['duration_hours'] ?? 1);

        // Validierung
        if ($stationId <= 0 || empty($licensePlate) || empty($startTime) || $duration < 1) {
            return ['success' => false, 'message' => 'Bitte alle Felder korrekt ausfüllen!'];
        }

        // Prüfung auf Kollision über das Model
        if (!$this->model->isStationAvailable($stationId, $startTime, $duration)) {
            return ['success' => false, 'message' => 'Diese Ladestation ist im gewählten Zeitraum bereits belegt!'];
        }

        // Speichern
        $success = $this->model->createBooking($stationId, $licensePlate, $startTime, $duration);
        if ($success) {
            return ['success' => true, 'message' => "Buchung für {$licensePlate} erfolgreich gespeichert!"];
        }

        return ['success' => false, 'message' => 'Datenbankfehler beim Speichern der Buchung.'];
    }
}