<?php

class RegisterView
{
    public static function render(): string
    {
        return '
        <div class="container mt-5" style="max-width: 600px;">
            <h1 class="mb-4">Registrierung</h1>

            <form method="POST" action="?page=register">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input
                        type="text"
                        class="form-control"
                        id="address"
                        name="address"
                        required
                    >
                </div>

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
                    Registrieren
                </button>

            </form>

            <p class="mt-3">
                Bereits registriert?
                <a href="?page=login">Zum Login</a>
            </p>
        </div>
        ';
    }
}