<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AuthLevelsTableSeeder extends Seeder {

	public function run()
	{
		AuthLevel::create([
			'resource' => 'authlevels',
			'maintenance' => 1,
			'query' => 1
		]);
		AuthLevel::create([
			'resource' => 'users',
			'maintenance' => 1,
			'query' => 1
		]);
		AuthLevel::create([
			'resource' => 'roles',
			'maintenance' => 1,
			'query' => 1
		]);
		AuthLevel::create([
			'resource' => 'announcements',
			'maintenance' => 3,
			'query' => 2
		]);

		AuthLevel::create([
			'resource' => 'events',
			'maintenance' => 3,
			'query' => 2
		]);
		AuthLevel::create([
			'resource' => 'sermons',
			'maintenance' => 2,
			'query' => 3
		]);
		AuthLevel::create([
			'resource' => 'apps',
			'maintenance' => 1,
			'query' => 1
		]);		
		AuthLevel::create([
			'resource' => 'advisories',
			'maintenance' => 1,
			'query' => 1
		]);		
	}

}