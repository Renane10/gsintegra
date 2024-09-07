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
        // Inicializa a sessão
        session_start();
        // Lógica para processar o login
        $username = $_POST['username'] ?: '';
        $password = $_POST['password'] ?: '';
        // Passa a conexão PDO ao criar uma instância de User
        $user = new User($this->pdo);
        $result = $user->validateUser($username, $password);

        if ($result['success']) {
            $_SESSION['user'] = $result['user'];
            echo "Login successful!";
        } else {
            echo "Login failed!";
        }
    }
}
