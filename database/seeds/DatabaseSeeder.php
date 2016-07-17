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
            'firstname' => 'Michael Adam',
            'lastname' => 'Trinidad',
            'email' => 'admin@adam.com',
            'password' => bcrypt('adminadmin'),
            'privelege' => 'Admin'
        ]);

        DB::table('users')->insert([
        	'firstname' => 'Michael Adam',
        	'lastname' => 'Trinidad',
        	'email' => 'adam@adam.com',
        	'password' => bcrypt('adamadam')
        	]);
    }
}
