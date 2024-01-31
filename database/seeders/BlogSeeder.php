<?php

namespace Database\Seeders;

use App\Models\blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        blog::factory()->count(11)->create();
    }
}
