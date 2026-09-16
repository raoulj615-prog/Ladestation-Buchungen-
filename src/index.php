<?php
// src/index.php
session_start();

require_once __DIR__ . '/classes/BookingController.php';
require_once __DIR__ . '/views/HomeView.php';
require_once __DIR__ . '/views/MyBookingsView.php';

$page = $_GET['page'] ?? 'home';
$controller = new BookingController();

$title = 'VoltReserve';
$content = '';

// Routing über den Front Controller
switch ($page) {
    case 'bookings':
        $title = 'Buchungsübersicht - VoltReserve';
        $bookings = $controller->getBookings();
        $content = MyBookingsView::render($bookings);
        break;

    case 'home':
    default:
        $title = 'Station buchen - VoltReserve';
        $stations = $controller->getStations();
        $content = HomeView::render($stations);
        break;
}

// Template einbinden
require_once __DIR__ . '/templates/default.php';