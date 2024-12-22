<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Members extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'user_id' => 1,
                'name' => 'Alice Johnson',
                'role' => 'Team Leader',
                'description' => 'Responsible for managing the team and overseeing operations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Bob Smith',
                'role' => 'Developer',
                'description' => 'Works on software development and debugging tasks.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null, // No associated user
                'name' => 'Charlie Brown',
                'role' => null, // Role not assigned
                'description' => 'External consultant providing strategic advice.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'name' => 'Diana Prince',
                'role' => 'QA Engineer',
                'description' => 'Ensures quality control and testing of products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
