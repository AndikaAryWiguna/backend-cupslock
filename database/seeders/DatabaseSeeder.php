<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Jika Mau langsung Menggunakan Factory Dengan Data Random Bisa Menggunakan yang dibawah ini
        // Post::factory(50)->recycle([
        //     Kategori::factory(5)->create(),
        //     User::factory(5)->create()
        // ])->create();

        // Jika ingin mengubah data factory supaya sedikit sesuai dengan keinginan kita
        // Maka buatkan seeder dulu kemudian akan dipanggil dengan cara di bawah
        $this->call([CategorySeeder::class, UserSeeder::class, ProductSeeder::class,]);
        Post::factory(50)->recycle([
            Category::all(),
            Product::all(),
            User::all()
        ])->create();
                
    }
}
