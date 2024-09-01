<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Usuarios extends AbstractMigration
{
    public function change(): void
    {
        // Cria a tabela 'usuarios'
        $table = $this->table('usuarios');

        // Adiciona as colunas
        $table->addColumn('nome', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 150, 'null' => false])
              ->addColumn('senha', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('permissao', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('criado_em', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('atualizado_em', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
              ->create();

        // Adiciona índice único para a coluna 'email'
        $this->table('usuarios')->addIndex(['email'], ['unique' => true])->update();
    }
}
