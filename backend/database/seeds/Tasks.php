<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tasks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_member')->insert([
            [
                'task' => 'Initial Design',
                'hours' => 40,
                'member_id' => 1, // Alice Johnson
                'project_id' => 1, // Project Alpha
                'description' => 'Design the architecture for Project Alpha.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Backend Development',
                'hours' => 60,
                'member_id' => 2, // Bob Smith
                'project_id' => 2, // Project Beta
                'description' => 'Develop APIs for Project Beta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Consultation',
                'hours' => null,
                'member_id' => 3, // Charlie Brown
                'project_id' => 3, // Project Gamma
                'description' => 'Provide strategic advice on frontend design.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Testing',
                'hours' => 30,
                'member_id' => 4, // Diana Prince
                'project_id' => 4, // Project Delta
                'description' => 'Perform quality assurance testing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
