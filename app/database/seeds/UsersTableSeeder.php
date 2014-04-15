<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

		//foreach(range(1, 10) as $index)
		//{
			$user = User::create(
				array(
					'username' => 'admin',
					'email' => 'dylan.jacob@bubblecore.net',
					'firstName' => 'Admin',
					'lastName' => 'User',
					'password' => Hash::make('P@ssw0rd')					
				)
			);
			Role::find(0)->user()->save($user);
		//}
	}

}