<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		Role::create(['role' => 'Administrator', 'enabled' => true]);
		Role::create(['role' => 'User', 'enabled' => true]);
		Role::create(['role' => 'Guest', 'enabled' => true]);
		Role::create(['role' => 'Editor', 'enabled' => false]);
	}

}