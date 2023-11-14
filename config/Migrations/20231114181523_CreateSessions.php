<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSessions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('sessions', ['collation' => 'ascii_bin', 'id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'char', ['limit' => 40, 'null' => false])
            ->addColumn('data', 'blob')
            ->addColumn('expires', 'integer', ['signed' => false])
            ->addTimestamps();
        $table->create();
    }
}
