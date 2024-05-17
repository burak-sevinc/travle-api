<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Travle\Shared\Adapters\Persistence\Eloquent\Models\User;
use Travle\Shared\ValueObjects\UserId;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'uuid' => Uuid::uuid4(),
            'email' => 'admin@admin.com',
        ]);

//        User::newFactory()->count(10)->create();
    }
}
