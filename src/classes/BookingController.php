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
        $userId = $_SESSION['user_id'] ?? 0;

        if ($userId <= 0) {
            return [];
        }

        return $this->model->getBookings($userId);
    }

    // Verarbeitet die Buchungsanfrage
    public function processBooking(array $data): array {
        $stationId    = intval($data['station_id'] ?? 0);
        $licensePlate = trim($data['license_plate'] ?? '');
        $startTime    = $data['start_time'] ?? '';
        $duration     = intval($data['duration_hours'] ?? 1);

        // Validierung
        if (
            $stationId <= 0 ||
            empty($licensePlate) ||
            empty($startTime) ||
            $duration < 1 ||
            $duration > 3
        ) {
            return [
                'success' => false,
                'message' => 'Bitte alle Felder korrekt ausfüllen!'
            ];
        }

        // Datum prüfen
        $startDate = DateTime::createFromFormat('Y-m-d\TH:i', $startTime);

        if (!$startDate || $startDate->format('Y-m-d\TH:i') !== $startTime) {
            return [
                'success' => false,
                'message' => 'Bitte geben Sie ein gültiges Datum und eine gültige Uhrzeit ein.'
            ];
        }

        // Datum darf nicht in der Vergangenheit liegen
        $now = new DateTime();

        if ($startDate < $now) {
            return [
                'success' => false,
                'message' => 'Eine Buchung in der Vergangenheit ist nicht möglich.'
            ];
        }

        // Prüfung auf Kollision über das Model
        if (!$this->model->isStationAvailable($stationId, $startTime, $duration)) {
            return [
                'success' => false,
                'message' => 'Diese Ladestation ist im gewählten Zeitraum bereits belegt!'
            ];
        }

        // Speichern
        $userId = $_SESSION['user_id'] ?? 0;

        if ($userId <= 0) {
            return [
                'success' => false,
                'message' => 'Bitte melden Sie sich zuerst an.'
            ];
        }

        $success = $this->model->createBooking(
            $userId,
            $stationId,
            $licensePlate,
            $startTime,
            $duration
        );

        if ($success) {
            return [
                'success' => true,
                'message' => "Buchung für {$licensePlate} erfolgreich gespeichert!"
            ];
        }

        return [
            'success' => false,
            'message' => 'Datenbankfehler beim Speichern der Buchung.'
        ];
    }

    public function deleteBooking(int $bookingId): bool {
        $userId = $_SESSION['user_id'] ?? 0;

        if ($userId <= 0) {
            return false;
        }

        return $this->model->deleteBooking($bookingId, $userId);
    }
}