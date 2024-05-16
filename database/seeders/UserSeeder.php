<?php

declare(strict_types=1);

namespace Database\Seeders;

use Crackcode\Shared\Adapters\Persistence\Eloquent\Models\User;
use Illuminate\Database\Seeder;

use function bcrypt;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Password123'),
        ]);

        User::create([
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => bcrypt('Password123'),
        ]);

        User::newFactory()->count(10)->create();
    }
}
