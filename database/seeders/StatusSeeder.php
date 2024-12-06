<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::createOrFirst(['name'=>'Pending','slug'=>'pending']);
        Status::createOrFirst(['name'=>'In Progress','slug'=>'in_progress']);
        Status::createOrFirst(['name'=>'Completed','slug'=>'completed']);
    }
}
