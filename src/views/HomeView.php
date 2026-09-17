<?php
// src/views/HomeView.php

class HomeView
{
    public static function render(array $stations): string
    {
        ob_start();
        ?>

        <!-- Fortschrittsanzeige -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col">
                        <strong id="step1Label" class="text-primary">
                            1. Station auswählen
                        </strong>
                    </div>
                    <div class="col">
                        <strong id="step2Label" class="text-muted">
                            2. Buchungsdaten
                        </strong>
                    </div>
                    <div class="col">
                        <strong id="step3Label" class="text-muted">
                            3. Zusammenfassung
                        </strong>
                    </div>
                </div>
            </div>
        </div>


        <!-- ========================= -->
        <!-- SCHRITT 1 -->
        <!-- ========================= -->

        <div id="step1">

            <h3 class="mb-3">Ladestation auswählen</h3>

            <div class="row">

                <?php foreach ($stations as $s): ?>

                    <div class="col-md-4 mb-3">

                        <div class="card shadow-sm border-0 h-100">

                            <div class="card-body">

                                <h5 class="card-title text-primary">
                                    <?= htmlspecialchars($s['name']); ?>
                                </h5>

                                <p class="mb-1">
                                    <strong>Typ:</strong>
                                    <?= htmlspecialchars($s['type']); ?>
                                </p>

                                <p class="mb-1">
                                    <strong>Leistung:</strong>
                                    <?= intval($s['power_kw']); ?> kW
                                </p>

                                <p class="text-muted">
                                    Tarif:
                                    <?= number_format($s['price_kwh'], 2, ',', '.'); ?>
                                    € / kWh
                                </p>

                                <button
                                    type="button"
                                    class="btn btn-outline-primary w-100"
                                    onclick="selectStation(
                                        <?= $s['id']; ?>,
                                        '<?= htmlspecialchars($s['name'], ENT_QUOTES); ?>'
                                    )"
                                >
                                    Diese Station auswählen
                                </button>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <div class="text-end mt-3">

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="goToStep2()"
                >
                    Weiter
                </button>

            </div>

        </div>


        <!-- ========================= -->
        <!-- SCHRITT 2 -->
        <!-- ========================= -->

        <div id="step2" class="d-none">

            <h3 class="mb-3">Buchungsdaten</h3>

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <input
                        type="hidden"
                        id="station_id"
                    >

                    <div class="mb-3">

                        <label class="form-label">
                            Ausgewählte Station
                        </label>

                        <input
                            type="text"
                            id="station_display"
                            class="form-control"
                            readonly
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Kfz-Kennzeichen
                        </label>

                        <input
                            type="text"
                            id="license_plate"
                            class="form-control"
                            placeholder="z. B. GI-XY 123"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Startzeitpunkt
                        </label>

                        <input
                            type="datetime-local"
                            id="start_time"
                            class="form-control"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Ladedauer
                        </label>

                        <select
                            id="duration_hours"
                            class="form-select"
                        >
                            <option value="1">1 Stunde</option>
                            <option value="2">2 Stunden</option>
                            <option value="3">3 Stunden</option>
                        </select>

                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-between mt-3">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="goToStep1()"
                >
                    Zurück
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="goToStep3()"
                >
                    Weiter
                </button>

            </div>

        </div>


        <!-- ========================= -->
        <!-- SCHRITT 3 -->
        <!-- ========================= -->

        <div id="step3" class="d-none">

            <h3 class="mb-3">
                Zusammenfassung
            </h3>

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h5 class="mb-4">
                        Bitte überprüfen Sie Ihre Buchung
                    </h5>

                    <p>
                        <strong>Ladestation:</strong>
                        <span id="summary_station"></span>
                    </p>

                    <p>
                        <strong>Kfz-Kennzeichen:</strong>
                        <span id="summary_license"></span>
                    </p>

                    <p>
                        <strong>Startzeitpunkt:</strong>
                        <span id="summary_start"></span>
                    </p>

                    <p>
                        <strong>Ladedauer:</strong>
                        <span id="summary_duration"></span>
                    </p>

                </div>

            </div>


            <div id="alertBox" class="alert d-none mt-3"></div>


            <div class="d-flex justify-content-between mt-3">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="goToStep2()"
                >
                    Zurück
                </button>

                <button
                    type="button"
                    class="btn btn-success"
                    onclick="submitBooking()"
                >
                    Jetzt verbindlich buchen
                </button>

            </div>

        </div>


        <script>

        let selectedStationId = '';
        let selectedStationName = '';


        // Station auswählen
        function selectStation(id, name)
        {
            selectedStationId = id;
            selectedStationName = name;

            document.getElementById('station_id').value = id;
            document.getElementById('station_display').value = name;
        }


        // Schritt 1 -> Schritt 2
        function goToStep2()
        {
            if (!selectedStationId)
            {
                alert('Bitte wählen Sie zuerst eine Ladestation aus.');
                return;
            }

            document.getElementById('step1')
                .classList.add('d-none');

            document.getElementById('step2')
                .classList.remove('d-none');

            updateStepLabels(2);
        }


        // Schritt 2 -> Schritt 1
        function goToStep1()
        {
            document.getElementById('step2')
                .classList.add('d-none');

            document.getElementById('step3')
                .classList.add('d-none');

            document.getElementById('step1')
                .classList.remove('d-none');

            updateStepLabels(1);
        }


        // Schritt 2 -> Schritt 3
        function goToStep3()
        {
            const licensePlate =
                document.getElementById('license_plate').value.trim();

            const startTime =
                document.getElementById('start_time').value;

            if (!licensePlate || !startTime)
            {
                alert('Bitte füllen Sie alle Felder aus.');
                return;
            }

            document.getElementById('summary_station')
                .textContent = selectedStationName;

            document.getElementById('summary_license')
                .textContent = licensePlate;

            document.getElementById('summary_start')
                .textContent = startTime.replace('T', ' ');

            const duration =
                document.getElementById('duration_hours').value;

            document.getElementById('summary_duration')
                .textContent =
                duration + (duration === '1'
                    ? ' Stunde'
                    : ' Stunden');


            document.getElementById('step2')
                .classList.add('d-none');

            document.getElementById('step3')
                .classList.remove('d-none');

            updateStepLabels(3);
        }


        // Buchung endgültig absenden
        async function submitBooking()
        {
            const alertBox =
                document.getElementById('alertBox');

            alertBox.classList.add('d-none');


            const payload = {

                station_id: selectedStationId,

                license_plate:
                    document.getElementById('license_plate').value,

                start_time:
                    document.getElementById('start_time').value,

                duration_hours:
                    document.getElementById('duration_hours').value
            };


            try
            {
                const response = await fetch(
                    'api/book.php',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json'
                        },

                        body: JSON.stringify(payload)
                    }
                );


                const result =
                    await response.json();


                alertBox.classList.remove('d-none');


                if (result.success)
                {
                    alertBox.className =
                        'alert alert-success mt-3';

                    alertBox.textContent =
                        result.message;

                    document.getElementById('license_plate')
                        .value = '';

                    document.getElementById('start_time')
                        .value = '';

                    document.getElementById('duration_hours')
                        .value = '1';

                }
                else
                {
                    alertBox.className =
                        'alert alert-danger mt-3';

                    alertBox.textContent =
                        result.message;
                }

            }
            catch (error)
            {
                alertBox.className =
                    'alert alert-danger mt-3';

                alertBox.classList.remove('d-none');

                alertBox.textContent =
                    'Serverfehler beim Senden des Buchungswunschs!';
            }
        }


        // Fortschrittsanzeige
        function updateStepLabels(currentStep)
        {
            const labels = [
                document.getElementById('step1Label'),
                document.getElementById('step2Label'),
                document.getElementById('step3Label')
            ];


            labels.forEach((label, index) =>
            {
                if (index + 1 === currentStep)
                {
                    label.classList.remove('text-muted');
                    label.classList.add('text-primary');
                }
                else
                {
                    label.classList.remove('text-primary');
                    label.classList.add('text-muted');
                }
            });
        }

        </script>

        <?php
        return ob_get_clean();
    }
}