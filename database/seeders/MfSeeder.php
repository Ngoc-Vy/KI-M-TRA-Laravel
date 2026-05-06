<?php

namespace Database\Seeders;
use App\Models\Mf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Mf::factory()->count(6)->create();  //có 6 hãng thì sinh 6 bản ghi, 10 hãng thì sinh 10
}
}
