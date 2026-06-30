<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'      => 'admin_bk',
            'email'         => 'admin@sekolah.sch.id',
            'password_hash' => Hash::make('Admin@2024'),
            'role'          => 'admin',
        ]);

        $categories = [
            ['category_name' => 'Kekerasan Fisik & Perundungan (Bullying)', 'weight_level' => 'Berat'],
            ['category_name' => 'Cyberbullying & Intimidasi Digital', 'weight_level' => 'Sedang'],
            ['category_name' => 'Pemerasan & Pemajakan Liar (Extortion)', 'weight_level' => 'Berat'],
            ['category_name' => 'Penyalahgunaan Wewenang & Praktik Korupsi', 'weight_level' => 'Berat'],
            ['category_name' => 'Pelanggaran Etik Pendidik & Staf', 'weight_level' => 'Sedang'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}