<?php

require_once __DIR__ . '/UserModel.php';

class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register(
        string $name,
        string $address,
        string $email,
        string $password
    ): array {
        if ($this->userModel->findByEmail($email)) {
            return [
                'success' => false,
                'message' => 'Diese E-Mail-Adresse ist bereits registriert.'
            ];
        }

        $this->userModel->createUser(
            $name,
            $address,
            $email,
            $password
        );

        return [
            'success' => true,
            'message' => 'Registrierung erfolgreich.'
        ];
    }

    public function login(string $email, string $password): array
    {
        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'E-Mail oder Passwort ist falsch.'
            ];
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        return [
            'success' => true,
            'message' => 'Login erfolgreich.'
        ];
    }

    public function logout(): void
    {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_name'],
            $_SESSION['user_email']
        );
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}