<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class ScopeTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

		//foreach(range(1, 10) as $index)
		//{
			Scope::create([
				'scope' => 'basic',
				'name' => 'Basic Scope',
				'description' => 'General Use'
			]);
		//}
	}

}