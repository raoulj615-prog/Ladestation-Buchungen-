<?php
// src/index.php
session_start();
date_default_timezone_set('Europe/Berlin');

require_once __DIR__ . '/classes/BookingController.php';
require_once __DIR__ . '/classes/AuthController.php';
require_once __DIR__ . '/views/HomeView.php';
require_once __DIR__ . '/views/MyBookingsView.php';
require_once __DIR__ . '/views/RegisterView.php';
require_once __DIR__ . '/views/LoginView.php';
require_once __DIR__ . '/views/LandingView.php';

$page = $_GET['page'] ?? 'landing';
$controller = new BookingController();

$title = 'VoltReserve';
$content = '';

// Routing über den Front Controller
switch ($page) {

    case 'register':
        $title = 'Registrierung - VoltReserve';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController = new AuthController();

            $result = $authController->register(
                $_POST['name'] ?? '',
                $_POST['address'] ?? '',
                $_POST['email'] ?? '',
                $_POST['password'] ?? ''
            );

            if ($result['success']) {
                header('Location: ?page=login');
                exit;
            }

            $content = '<div class="alert alert-danger">' .
                htmlspecialchars($result['message']) .
                '</div>' .
                RegisterView::render();
        } else {
            $content = RegisterView::render();
        }
        break;

    case 'login':
        $title = 'Login - VoltReserve';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController = new AuthController();

            $result = $authController->login(
                $_POST['email'] ?? '',
                $_POST['password'] ?? ''
            );

            if ($result['success']) {
                header('Location: ?page=home');
                exit;
            }

            $content = '<div class="alert alert-danger">' .
                htmlspecialchars($result['message']) .
                '</div>' .
                LoginView::render();
        } else {
            $content = LoginView::render();
        }
        break;

        case 'logout':
    $authController = new AuthController();
    $authController->logout();

    header('Location: ?page=landing');
    exit;

    case 'cancelBooking':

    if (!isset($_SESSION['user_id'])) {
        header('Location: ?page=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $bookingId = intval($_POST['booking_id'] ?? 0);

        if ($bookingId > 0) {
            $controller->deleteBooking($bookingId);
        }
    }

    header('Location: ?page=bookings');
    exit;
    
    case 'bookings':
        $title = 'Buchungsübersicht - VoltReserve';
        $bookings = $controller->getBookings();
        $content = MyBookingsView::render($bookings);
        break;

    case 'landing':
    $title = 'Willkommen bei VoltReserve';
    $content = LandingView::render();
    break;

case 'home':

    if (!isset($_SESSION['user_id'])) {
        header('Location: ?page=login');
        exit;
    }

    $title = 'Station buchen - VoltReserve';
    $stations = $controller->getStations();
    $content = HomeView::render($stations);
    break;

default:
    header('Location: ?page=landing');
    exit;
}

// Template einbinden
require_once __DIR__ . '/templates/default.php';