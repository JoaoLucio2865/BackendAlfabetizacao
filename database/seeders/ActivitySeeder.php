<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder {
    public function run() {
        $admin = User::firstOrCreate(['name' => 'professora'], ['role' => 'admin', 'password' => bcrypt('senha123')]);

        Activity::create([
            'title' => 'Formar Sílabas Básicas',
            'type' => 'syllables',
            'items' => ['CA', 'SA', 'A'],
            'level' => 'easy',
            'created_by' => $admin->id
        ]);
    }
}