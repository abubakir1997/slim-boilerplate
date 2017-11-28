<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $users = $this->table('users');
        $users
            ->addColumn('username',     'string',   ['length' => 25])
            ->addColumn('password',     'string',   ['length' => 32])
            ->addColumn('token',        'string',   ['length' => 25, 'null' => true])
            ->addColumn('token_expire', 'datetime', ['null' => true])
            ->addColumn('created_at',   'datetime')
            ->addColumn('updated_at',   'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->save()
        ;
    }
}