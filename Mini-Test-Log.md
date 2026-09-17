# Testfälle

| Datum | Testfall | Erwartet | Ergebnis | Notizen |
|---|---|---|---|---|
| 17.09.2026 | Registrierung mit neuen Benutzerdaten | Benutzer wird erfolgreich angelegt | Erfolgreich | Benutzer wird in der Datenbank gespeichert |
| 17.09.2026 | Login mit gültigen Daten | Benutzer wird angemeldet | Erfolgreich | Session wird erstellt |
| 17.09.2026 | Login mit falschem Passwort | Fehlermeldung wird angezeigt | Erfolgreich | Login wird abgelehnt |
| 17.09.2026 | Ladestation auswählen | Ausgewählte Station wird übernommen | Erfolgreich | Station wird im nächsten Schritt angezeigt |
| 16.09.2026 | Buchung mit vollständigen Daten | Buchung wird gespeichert und in der Buchungsübersicht angezeigt | Erfolgreich | Säule 1 – Friedberg Süd, Kennzeichen GI-XY 123, 1 Stunde |
| 17.09.2026 | Doppelbuchung einer belegten Ladestation | Buchung wird verhindert | Erfolgreich | Säule 2 – Campus Friedberg, 22:00–23:00 Uhr überschneidet sich mit bestehender Buchung 21:30–22:30 Uhr |
| 17.09.2026 | Eigene Buchungen anzeigen | Eigene Buchungen werden angezeigt | Erfolgreich | Buchungen werden anhand der user_id geladen |
| 17.09.2026 | Eigene Buchung stornieren | Buchung wird nach Bestätigung gelöscht | Erfolgreich | Stornierung über „Meine Buchungen“ |
| 17.09.2026 | Buchungsstatus anzeigen | Status wird abhängig vom Zeitpunkt angezeigt | Erfolgreich | „Bevorstehend“ und „Aktiv“ getestet |