<?php

namespace App\Models;
use PDO; 

class User
{
    private $pdo;

    // Construtor para receber a conexão com o banco de dados
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function validateUser($username, $password)
    {
        // Consulta o banco de dados para verificar o usuário e a senha
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e se a senha é válida
        if ($user && password_verify($password, $user['senha'])) {
            return true;
        }

        return false;
    }

    public function createUser($username, $email, $password,$permissao)
    {
        // Insere um novo usuário no banco de dados com a senha criptografada
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha, permissao) VALUES (:nome, :email, :senha,:permissao)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hashPassword);
        $stmt->bindParam(':admin', $permissao);

        return $stmt->execute();
    }
}
