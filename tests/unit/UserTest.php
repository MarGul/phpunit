<?php

use \PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

	protected $user;

	public function setUp()
	{
		// Will be called be for every single test.
		$this->user = new \App\Models\User;
	}

	/** @test */
	public function that_we_can_set_first_name()
	{
		$this->user->setFirstName('Marcus');

		$this->assertEquals($this->user->getFirstName(), 'Marcus');
	}

	/** @test */
	public function that_we_can_set_last_name()
	{
		$this->user->setLastName('Gullberg');

		$this->assertEquals($this->user->getLastName(), 'Gullberg');
	}

	/** @test */
	public function full_name_is_returned()
	{
		$this->user->setFirstName('Marcus');
		$this->user->setLastName('Gullberg');

		$this->assertEquals($this->user->getFullName(), 'Marcus Gullberg');
	}

	/** @test */
	public function first_and_last_name_are_trimmed()
	{
		$this->user->setFirstName('Marcus             ');
		$this->user->setLastName('         Gullberg          ');

		$this->assertEquals($this->user->getFirstName(), 'Marcus');
		$this->assertEquals($this->user->getLastName(), 'Gullberg');
	}

	/** @test */
	public function that_we_can_set_email()
	{
		$this->user->setEmail('marcus@gullberg.se');

		$this->assertEquals($this->user->getEmail(), 'marcus@gullberg.se');
	}

	/** @test */
	public function email_variables_containe_correct_values()
	{
		$this->user->setFirstName('Marcus');
		$this->user->setLastName('Gullberg');
		$this->user->setEmail('marcus@gullberg.se');

		$emailVaraibles = $this->user->getEmailVariables();

		$this->assertArrayHasKey('fullName', $emailVaraibles);
		$this->assertArrayHasKey('email', $emailVaraibles);

		$this->assertEquals($emailVaraibles['fullName'], 'Marcus Gullberg');
		$this->assertEquals($emailVaraibles['email'], 'marcus@gullberg.se');

	}


}