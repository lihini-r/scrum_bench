<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
			'designation' => 'Admin',
        ]);
		DB::table('users')->insert([
            'name' => 'dev',
            'email' => 'dev@gmail.com',
            'password' => bcrypt('dev123'),
			'designation' => 'Developer',
        ]);
		DB::table('users')->insert([
            'name' => 'pm',
            'email' => 'pm@gmail.com',
            'password' => bcrypt('pm123'),
			'designation' => 'Developer',
        ]);

		DB::table('users')->insert([
			'name' => 'parmer',
			'email' => 'sajjf@gmail.com',
			'password' => bcrypt('paramer123'),

			'designation' => 'Project Manager',
		]);

		DB::table('users')->insert([
			'name' => 'adam',
			'email' => 'addam@gmail.com',
			'password' => bcrypt('adam123'),
			'designation' => 'Project Manager',

		]);

		DB::table('users')->insert([
			'name' => 'Amal',
			'email' => 'kamal@gmail.com',
			'password' => bcrypt('kamal123'),
			'designation' => 'Account Head',

		]);


		DB::table('users')->insert([
			'name' => 'Sunil',
			'email' => 'amal@gmail.com',
			'password' => bcrypt('amal123'),
			'designation' => 'Account Head',

		]);
		DB::table('users')->insert([
			'name' => 'kusal',
			'email' => 'kusal@gmail.com',
			'password' => bcrypt('kusal123'),
			'designation' => 'Developer',

		]);





	}

}
