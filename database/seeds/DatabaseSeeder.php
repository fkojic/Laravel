<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('KategorijeTableSeeder');
        $this->call('AutomobiliTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        User::create([
                'name' => $faker->name,
                'admin' => '1',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password')
            ]);
        User::create([
                'name' => $faker->name,
                'admin' => '0',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password')
            ]);

        for($i=0; $i<10; $i++){
            User::create([
                'name' => $faker->name,
                'admin' => '0',
                'email' => $faker->email,
                'password' => bcrypt('password')
            ]);
        }

        $this->command->info('User table seeded!');
    }

}
