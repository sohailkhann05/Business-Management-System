<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SuperAdmin::create([
            'name' => 'Adnan Khalil',
            'email' => 'malakandsoft@malakandsoft.net',
            'password' => bcrypt('malakandsoft'),
            'hint' => 'malakandsoft'
        ]);
    }
}
