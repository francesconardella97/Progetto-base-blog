<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->categories();
        $this->user();
    }


    private function categories()
    {
        \App\Models\Category::create(['name' => 'Esteri']);
        \App\Models\Category::create(['name' => 'Politica']);
        \App\Models\Category::create(['name' => 'Sport']);
        \App\Models\Category::create(['name' => 'Economia']);


        // for ($i = 1; $i <= 100; $i++) {
        //     // \App\models\Category::create(['name' => 'categoria' . $i]);    //PHP ARTISAN MIGRATE:REFRESH --SEED (AGGIORNA E SALVA IN TABLE PLUS)
        // }
                                                                       
    }


    private function user()
    {
        \App\models\User::create([
            'name' => 'Giuseppe',
            'email' => 'francesco@example.it',
            'password' => \Illuminate\Support\Facades\Hash::make('pass123@'),
        ]);

    }
}
