<?php
// src/views/HomeView.php

class HomeView {
    public static function render(array $stations): string {
        ob_start();
        ?>
        <div class="row">
            <!-- Linke Spalte: Verfügbare Stationen -->
            <div class="col-md-7">
                <h3 class="mb-3">Verfügbare Ladepunkte</h3>
                <div class="row">
                    <?php foreach ($stations as $s): ?>
                        <div class="col-12 mb-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><?= htmlspecialchars($s['name']); ?></h5>
                                    <p class="card-text mb-1">
                                        <strong>Typ:</strong> <?= htmlspecialchars($s['type']); ?> | 
                                        <strong>Leistung:</strong> <?= intval($s['power_kw']); ?> kW
                                    </p>
                                    <p class="text-muted">Tarif: <?= number_format($s['price_kwh'], 2, ',', '.'); ?> € / kWh</p>
                                    <button class="btn btn-outline-primary btn-sm" onclick="selectStation(<?= $s['id']; ?>, '<?= htmlspecialchars($s['name']); ?>')">
                                        Diese Station auswählen
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Rechte Spalte: Buchungsformular -->
            <div class="col-md-5">
                <div class="card shadow-sm p-4">
                    <h4 class="card-title mb-3">Ladepunkt reservieren</h4>
                    
                    <div id="alertBox" class="alert d-none"></div>

                    <form id="bookingForm" onsubmit="submitBooking(event)">
                        <input type="hidden" name="station_id" id="station_id" required>

                        <div class="mb-3">
                            <label class="form-label">Ausgewählte Station</label>
                            <input type="text" id="station_display" class="form-control" placeholder="Bitte links auswählen" readonly required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kfz-Kennzeichen</label>
                            <input type="text" name="license_plate" id="license_plate" class="form-control" placeholder="z. B. GI-XY 123" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Startzeitpunkt</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ladedauer</label>
                            <select name="duration_hours" id="duration_hours" class="form-select">
                                <option value="1">1 Stunde</option>
                                <option value="2">2 Stunden</option>
                                <option value="3">3 Stunden</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Reservierung bestätigen</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Asynchrones JavaScript mit modernem fetch() (Folie 5/6, Ajax) -->
        <script>
        function selectStation(id, name) {
            document.getElementById('station_id').value = id;
            document.getElementById('station_display').value = name;
        }

        async function submitBooking(event) {
            event.preventDefault(); // Verhindert Standard-Reload (Folie Form-Validierung)
            
            const alertBox = document.getElementById('alertBox');
            alertBox.classList.add('d-none');

            const payload = {
                station_id: document.getElementById('station_id').value,
                license_plate: document.getElementById('license_plate').value,
                start_time: document.getElementById('start_time').value,
                duration_hours: document.getElementById('duration_hours').value
            };

            try {
                // Asynchroner POST-Request via fetch API
                const response = await fetch('api/book.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                alertBox.classList.remove('d-none');
                if (result.success) {
                    alertBox.className = 'alert alert-success';
                    alertBox.textContent = result.message;
                    document.getElementById('bookingForm').reset();
                } else {
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = result.message;
                }
            } catch (err) {
                alertBox.classList.remove('d-none');
                alertBox.className = 'alert alert-danger';
                alertBox.textContent = 'Serverfehler beim Senden des Buchungswunschs!';
            }
        }
        </script>
        <?php
        return ob_get_clean();
    }
}