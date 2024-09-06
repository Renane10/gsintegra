<?php

namespace App\Controllers;

use App\Models\User;

class LoginController extends Controller
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showLogin()
    {
        $this->render('login');
    }

    public function processLogin()
    {
        // Lógica para processar o login
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        // Passa a conexão PDO ao criar uma instância de User
        $user = new User($this->pdo);
        $result = $user->validateUser($username, $password);

        if ($result) {
            echo "Login successful!";
        } else {
            echo "Login failed!";
        }
    }
}
