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
        ]);
		DB::table('users')->insert([
            'name' => 'dev',
            'email' => 'dev@gmail.com',
            'password' => bcrypt('dev123'),
        ]);
		DB::table('users')->insert([
            'name' => 'pm',
            'email' => 'pm@gmail.com',
            'password' => bcrypt('pm123'),
        ]);
	}

}
