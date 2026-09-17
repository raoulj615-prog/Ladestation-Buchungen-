<?php
// src/views/LandingView.php

class LandingView
{
    public static function render(): string
    {
        ob_start();
        ?>

        <!-- Hero-Bereich -->
        <div class="card shadow-lg border-0 mb-4 overflow-hidden">
            <div class="card-body p-5 text-center">

                <h1 class="display-4 fw-bold text-primary">
                    ⚡ Willkommen bei VoltReserve
                </h1>

                <p class="lead mt-3">
                    Einfach, schnell und bequem eine Ladestation reservieren.
                </p>

                <p class="text-muted">
                    Mit VoltReserve können Sie verfügbare Ladestationen
                    auswählen und einen passenden Ladezeitraum buchen.
                </p>

                <div class="mt-4">
    <img
        src="image/charging-station.png"
        alt="Elektroauto an einer Ladestation"
        class="img-fluid rounded shadow-sm"
        style="max-height: 350px; width: 100%; object-fit: cover;"
    >
</div>

                <div class="mt-4">
                    <a href="index.php?page=login"
                       class="btn btn-primary btn-lg me-2">
                        Anmelden
                    </a>

                    <a href="index.php?page=register"
                       class="btn btn-outline-primary btn-lg">
                        Registrieren
                    </a>
                </div>

            </div>
        </div>


        <!-- Informationen -->
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">

                        <div class="display-5 mb-3">🔌</div>

                        <h4>Verfügbare Ladestationen</h4>

                        <p class="text-muted">
                            Finden Sie passende Ladestationen
                            und wählen Sie Ihren gewünschten Ladepunkt aus.
                        </p>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">

                        <div class="display-5 mb-3">📅</div>

                        <h4>Flexible Buchung</h4>

                        <p class="text-muted">
                            Wählen Sie einen Startzeitpunkt und
                            die gewünschte Ladedauer.
                        </p>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">

                        <div class="display-5 mb-3">👤</div>

                        <h4>Ihre Buchungen</h4>

                        <p class="text-muted">
                            Nach dem Login können Sie Ihre
                            persönlichen Buchungen einsehen.
                        </p>

                    </div>
                </div>
            </div>

        </div>

        <?php
        return ob_get_clean();
    }
}