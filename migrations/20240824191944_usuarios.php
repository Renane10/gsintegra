<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Usuarios extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // Cria a tabela 'usuarios'
        $table = $this->table('usuarios');

        // Adiciona as colunas
        $table->addColumn('nome', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 150, 'null' => false, 'unique' => true])
              ->addColumn('senha', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('permissao', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('criado_em', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('atualizado_em', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}
