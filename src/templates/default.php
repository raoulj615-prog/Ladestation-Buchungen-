<!-- src/templates/default.php -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'VoltReserve - Ladestationen'); ?></title>
    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Hintergrundbild mit leicht abgedunkeltem Overlay für optimale Lesbarkeit */
            /* Falls lokales Bild verwendet wird: url('images/bg.jpg') */
            background: linear-gradient(rgba(240, 244, 248, 0.88), rgba(240, 244, 248, 0.88)), 
                        url('https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        /* Leichter Glaseffekt für die Bootstrap-Karten */
        .card {
            background-color: rgba(255, 255, 255, 0.93) !important;
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">⚡ VoltReserve</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php?page=home">Stationen buchen</a>
            <a class="nav-link" href="index.php?page=bookings">Buchungsübersicht</a>
        </div>
    </div>
</nav>

<div class="container flex-grow-1">
    <?= $content ?? ''; ?>
</div>

<footer class="text-center text-muted py-3 mt-4">
    <small>&copy; <?= date('Y'); ?> VoltReserve THM Web-Projekt</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>