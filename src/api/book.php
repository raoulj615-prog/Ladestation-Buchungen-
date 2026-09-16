<?php
// src/api/book.php
header('Content-Type: application/json');
require_once __DIR__ . '/../classes/BookingController.php';

// JSON-Body aus dem Fetch-Request einlesen
$input = file_get_contents('php://input');
$data = json_decode($input, true) ?? [];

$controller = new BookingController();
$result = $controller->processBooking($data);

// Antwort als JSON zurückgeben
echo json_encode($result);
exit;