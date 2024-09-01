<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

final class AdminUserSeed extends AbstractSeed
{
    public function run(): void
    {
        $defaultPassword = password_hash('123', PASSWORD_BCRYPT); // Hash da senha '123'

        $data = [
            [
                'nome' => 'admin',
                'email' => 'admin@example.com',
                'senha' => $defaultPassword,
                'permissao' => 'admin',
                'criado_em' => date('Y-m-d H:i:s'),
                'atualizado_em' => date('Y-m-d H:i:s')
            ]
        ];

        $this->table('usuarios')->insert($data)->saveData();
    }
}
