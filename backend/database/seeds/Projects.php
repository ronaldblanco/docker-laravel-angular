<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Projects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'Project Alpha',
                'hours' => 120,
                'description' => 'This is the first project.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Beta',
                'hours' => 80,
                'description' => 'This project focuses on backend optimization.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Gamma',
                'hours' => 150,
                'description' => 'This is a frontend design project.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Delta',
                'hours' => 100,
                'description' => null, // No description provided
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
