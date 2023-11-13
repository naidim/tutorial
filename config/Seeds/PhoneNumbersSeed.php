<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PhoneNumbers seed.
 */
class PhoneNumbersSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
           'UsersSeed'
        ];
    }
    
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
        ];

        $table = $this->table('phone_numbers');
        $table->insert($data)->save();
    }
}
