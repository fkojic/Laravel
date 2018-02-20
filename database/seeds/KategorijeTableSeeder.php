<?php

use Illuminate\Database\Seeder;
use App\Kategorije;

class KategorijeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Kategorije::create([
                'ime' => 'Audi',
            ]);
            Kategorije::create([
                'ime' => 'BMW',
            ]);
            Kategorije::create([
                'ime' => 'Škoda',
            ]);
            Kategorije::create([
                'ime' => 'Volkswagen',
            ]);
            Kategorije::create([
                'ime' => 'Ford',
            ]);
            Kategorije::create([
                'ime' => 'Peugeot',
            ]);
            Kategorije::create([
                'ime' => 'Citroën',
            ]);

        $this->command->info('Kategorije table seeded!');
    }
}
