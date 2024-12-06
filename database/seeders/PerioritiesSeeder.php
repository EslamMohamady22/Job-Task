<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create(['name'=>'Low','slug'=>'low']);
        Priority::create(['name'=>'Medium','slug'=>'medium']);
        Priority::create(['name'=>'High','slug'=>'high']);
    }
}
