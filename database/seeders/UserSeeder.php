<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Password for both users: password
        User::factory()->create([
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Test',
            'username' => 'test',
            'email' => 'test@test.com',
        ]);

        User::factory()->count(10)->create();
    }
}
