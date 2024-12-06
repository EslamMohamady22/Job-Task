<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::createOrFirst(['name'=>'Admin','email'=>'admin@gmail.com','password'=>bcrypt('123456789')]);
        $admin->assignRole('Admin');
    }
}
