<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class installHCC extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'installHCC';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh and Seed DB';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->call('migrate:refresh');
		$this->call('migrate', array('--package' => 'lucadegasperi/oauth2-server-laravel'));
		$this->call('db:seed');

		$user = User::create(['username' => 'admin','email' => 'dylan.jacob@bubblecore.net','firstName' => 'Admin','lastName' => 'User','password' => Hash::make('P@ssw0rd')]);
		$admin = Role::find(1)->users()->save($user);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			#array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			#array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
