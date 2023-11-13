<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePhoneNumbers extends AbstractMigration
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
    $table = $this->table('phone_numbers');
    $table->addColumn('user_id', 'integer', ['null' => false])
      ->addColumn('phone_number', 'string', ['limit' => 15, 'null' => false])
      // null is only necessary if false, true is default
      ->addColumn('type', 'string', ['limit' => 1, 'null' => false])
      ->addTimestamps(); // Adds the modified and created fields
    $table->create();
  }
}