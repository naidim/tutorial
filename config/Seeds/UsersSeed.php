<?php
declare(strict_types=1);

use Cake\Utility\Text;
use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
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
        $hasher = new DefaultPasswordHasher();
        $data = [
            [
                'username' => 'naidim',
                'password' => $hasher->hash('password'),
                'email' => 'naidim@gmail.com',
                'first_name' => 'Charles',
                'last_name' => 'Patterson',
                'slug' => mb_strtolower(Text::slug('Charles Patterson')),
                'role' => 'Admin',
            ],
        ];
        $table = $this->table('users');
        $table->truncate();
        $table->insert($data)->save();
    }
}
