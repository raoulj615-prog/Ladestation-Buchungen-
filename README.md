# VoltReserve – E-Ladestation Buchungssystem

Ein leichtgewichtiges Web-Buchungssystem für Ladestationen, entwickelt mit nativem PHP (MVC-Architektur), MariaDB/MySQL, Bootstrap 5 und asynchronem JavaScript (Fetch API).

## Features
- **Ladepunkt-Übersicht:** Auflistung verfügbarer Ladesäulen mit Leistungsdaten (kW) und Tarif.
- **Konfliktfreie Buchung:** Serverseitige Überschneidungsprüfung via SQL (`DATE_ADD`).
- **Asynchroner Buchungsablauf:** Statusaktualisierung ohne Seiten-Reload via `fetch()` (JSON-Payload).
- **MVC-Architektur:** Strikte Trennung von Front Controller, Model, Controller, Views und Templates.
- **Sicherheit:** Schutz vor SQL-Injections durch PDO Prepared Statements und XSS-Prävention über `htmlspecialchars()`.

## Installation & Start mit Docker
1. Repository klonen oder herunterladen:
   ```bash
   git clone <REPO_URL>
   cd <PROJEKT_ORDNER>