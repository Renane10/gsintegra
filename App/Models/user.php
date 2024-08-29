<?php

namespace App\Models;

class User
{
    public function validateUser($username, $password)
    {
        // Aqui você pode adicionar lógica para validar o usuário com o banco de dados
        return true; // Exemplo: sempre retorna verdadeiro
    }
}
