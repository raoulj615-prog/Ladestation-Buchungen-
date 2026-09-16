<?php
// src/views/MyBookingsView.php

class MyBookingsView {
    public static function render(array $bookings): string {
        ob_start();
        ?>
        <h3 class="mb-4">Aktuelle Buchungsübersicht</h3>
        <table class="table table-striped table-hover shadow-sm bg-white rounded">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Station</th>
                    <th>Kennzeichen</th>
                    <th>Beginn</th>
                    <th>Dauer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bookings)): ?>
                    <tr><td colspan="6" class="text-center py-3">Keine Buchungen vorhanden.</td></tr>
                <?php else: ?>
                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td>#<?= $b['id']; ?></td>
                            <td><strong><?= htmlspecialchars($b['station_name']); ?></strong> (<?= $b['power_kw']; ?> kW)</td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($b['license_plate']); ?></span></td>
                            <td><?= date('d.m.Y H:i', strtotime($b['start_time'])); ?> Uhr</td>
                            <td><?= $b['duration_hours']; ?> Std.</td>
                            <td><span class="badge bg-success">Bestätigt</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php?page=home" class="btn btn-primary">Zurück zur Buchung</a>
        <?php
        return ob_get_clean();
    }
}