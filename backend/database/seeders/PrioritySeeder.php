<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $priorities = [
            ['priority_name' => 'Low' , 'level' => 1,],
            ['priority_name' => 'Medium', 'level' => 2],
            ['priority_name' => 'High', 'level' => 3],
            ['priority_name' => 'emergency', 'level' => 4],
         ];
         foreach ($priorities as $priority) {
            \App\Models\Priorities::create($priority);
         }
    }
}
