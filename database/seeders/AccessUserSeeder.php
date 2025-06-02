<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccessUser;

class AccessUserSeeder extends Seeder
{
    public function run(): void
    {
        AccessUser::factory()->count(20)->create();
    }
}
