<?php

require_once __DIR__ . '/Database.php';

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function createUser(
        string $name,
        string $address,
        string $email,
        string $password
    ): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, address, email, password)
                VALUES (:name, :address, :email, :password)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
}