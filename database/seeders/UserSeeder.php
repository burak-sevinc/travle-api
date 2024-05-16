<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Travle\Shared\Adapters\Persistence\Eloquent\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(['email' => 'admin@admin.com']);
        User::create(['email' => 'admin1@admin.com']);

        User::newFactory()->count(10)->create();
    }
}
