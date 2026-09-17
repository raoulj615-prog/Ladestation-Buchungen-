<?php

class LoginView
{
    public static function render(): string
    {
        return '
        <div class="container mt-5" style="max-width: 600px;">
            <h1 class="mb-4">Login</h1>

            <form method="POST" action="?page=login">

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Einloggen
                </button>

            </form>

            <p class="mt-3">
                Noch kein Konto?
                <a href="?page=register">Jetzt registrieren</a>
            </p>
        </div>
        ';
    }
}