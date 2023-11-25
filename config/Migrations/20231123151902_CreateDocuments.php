<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDocuments extends AbstractMigration
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
        $table = $this->table('documents');
        $table->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('filename', 'string', ['limit' => 125, 'null' => false])
            ->addColumn('description', 'string')
            ->addTimestamps()
            ->addIndex('filename', ['name' => 'filename', 'unique' => true]);
        $table->create();
    }
}
