<?php

namespace App\Controllers;

use App\Models\User;

class LoginController extends Controller
{
    public function showLogin()
    {
        $this->render('login');
    }

    public function processLogin()
    {
        // Lógica para processar o login
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Aqui você pode validar o usuário
        $user = new User();
        $result = $user->validateUser($username, $password);

        if ($result) {
            echo "Login successful!";
        } else {
            echo "Login failed!";
        }
    }
}
