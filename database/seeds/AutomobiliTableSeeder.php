<?php

use Illuminate\Database\Seeder;
use App\Automobili;
use App\User;

class AutomobiliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Automobili::create([
                'ime' => 'BMW 530 XD SPORT LINE',
                'cena' => '58900',
                'godiste' => '2017',
                'km' => '19000',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1113/11131420/6f02dbd5b9c5-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '2'
        	]);
        Automobili::create([
                'ime' => 'Škoda Superb 2.0 tdi ambition',
                'cena' => '14990',
                'godiste' => '2015',
                'km' => '36000',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1186/11862755/9ce38a4c6288-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '3'
        	]);
        Automobili::create([
                'ime' => 'Volkswagen Touareg 3.0tdi led nav koza',
                'cena' => '31900',
                'godiste' => '2014',
                'km' => '158000',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1149/11492210/85dc741ccddb-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '4'
        	]);
        Automobili::create([
                'ime' => 'Ford Focus 1.5Tdci Trend',
                'cena' => '9500',
                'godiste' => '2014',
                'km' => '98000',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1035/10359519/c3888d0f2494-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '5'
        	]);
        Automobili::create([
                'ime' => 'Peugeot 508 2.0 BlueHDi Active',
                'cena' => '22990',
                'godiste' => '2017',
                'km' => '3',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1141/11419338/6fc12996594d-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '6'
        	]);
        Automobili::create([
                'ime' => 'Citroen DS5 2.0hdi Xen.Nav.Aut.',
                'cena' => '14350',
                'godiste' => '2014',
                'km' => '86000',
                'slika' => 'https://images3.polovniautomobili.tv/user-images/classifieds/1147/11476331/b79941083069-800x600.jpg',
                'user_id' => User::all()->random()->id,
                'kategorija_id' => '7'
        	]);
        $this->command->info('Automobili table seeded!');
    }
}
