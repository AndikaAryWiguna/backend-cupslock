<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Untuk Dibuatkan Kategori Secara random lewat factory gunakan yang di bawah ini
        // Kategori::factory(5)->create();

        // Jika Ingin Menampilkan data yang berbeda tidak sesuai dengan data random factory gunakan yang dibawah ini
        Kategori::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
            'color' => 'danger'
        ]);
        Kategori::create([
            'name' => 'UI UX',
            'slug' => 'ui-ux',
            'color' => 'info'
        ]);
        Kategori::create([
            'name' => 'Machine Learning',
            'slug' => 'machine-learning',
            'color' => 'warning'
        ]);
        Kategori::create([
            'name' => 'Quality Assurance',
            'slug' => 'quality-assurance',
            'color' => 'primary'
        ]);
        Kategori::create([
            'name' => 'System Analysis',
            'slug' => 'system-analysis',
            'color' => 'light'
        ]);
    }
}
