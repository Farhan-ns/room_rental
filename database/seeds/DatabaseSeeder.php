<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'privelege' => 'Admin'
        ]);

        DB::table('users')->insert([
        	'firstname' => 'Joshua',
        	'lastname' => 'Paredes',
        	'email' => 'joshuapards@gmail.com',
        	'password' => bcrypt('paredes')
        	]);
    }
}
