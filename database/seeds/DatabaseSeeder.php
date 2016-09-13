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
            'mobile' => '09502810005',
            'password' => bcrypt('admin'),
            'privelege' => 'Admin'
        ]);

        DB::table('users')->insert([
        	'firstname' => 'Joshua',
        	'lastname' => 'Paredes',
        	'email' => 'joshuapards@gmail.com',
            'mobile' => '09502810005',
        	'password' => bcrypt('paredes')
        	]);

        DB::table('users')->insert([
            'firstname' => 'Adam',
            'lastname' => 'Trinidad',
            'email' => 'madamt0001@gmail.com',
            'mobile' => '09156119134',
            'password' => bcrypt('adam')
            ]);

        DB::table('users')->insert([
            'firstname' => 'Michael',
            'lastname' => 'Adam',
            'email' => 'michaeladamtrinidad@gmail.com',
            'mobile' => '09156119134',
            'password' => bcrypt('adam')
            ]);
    }
}
