<!-- src/templates/default.php -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'VoltReserve - Ladestationen'); ?></title>
    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">⚡ VoltReserve</a>
        <div class="navbar-nav">
            <a class="nav-link" href="index.php?page=home">Stationen buchen</a>
            <a class="nav-link" href="index.php?page=bookings">Buchungsübersicht</a>
        </div>
    </div>
</nav>

<div class="container">
    <?= $content ?? ''; ?>
</div>

<footer class="text-center text-muted py-4 mt-5">
    <small>&copy; <?= date('Y'); ?> VoltReserve THM Web-Projekt</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>