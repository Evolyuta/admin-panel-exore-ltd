<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager1 = User::factory()->create([
            'name'       => 'Manager 1',
            'email'      => 'admin@test.com',
            'password'   => bcrypt('123456'),
            'is_manager' => true,
        ]);

        $manager2 = User::factory()->create([
            'name'       => 'Manager 2',
            'email'      => 'admin2@test.com',
            'password'   => bcrypt('123456'),
            'is_manager' => true,
        ]);

        User::factory()->create([
            'name'       => 'Employee 1',
            'email'      => 'employee@test.com',
            'password'   => bcrypt('123456'),
            'manager_id' => $manager1->id,
        ]);

        User::factory()->create([
            'name'       => 'Employee 2',
            'email'      => 'employee2@test.com',
            'password'   => bcrypt('123456'),
            'manager_id' => $manager2->id,
        ]);

    }
}
