<?php namespace Olssonm\Deploy;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Olssonm\Deploy\Deploy;

use Artisan;

class DeployTest extends \Orchestra\Testbench\BrowserKit\TestCase {

	private $file = 'app/deploy.txt';

	/**
	 * Test setup
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Load the package
	 * @return array the packages
	 */
	protected function getPackageProviders($app)
	{
		return [
			'Olssonm\Deploy\ServiceProvider'
		];
	}

	/**
	 * Basic package usage test
	 * @test
	 */
	public function testBasic()
	{
		// Check class
		$deploy = new Deploy($this->file);
		$this->assertTrue(get_class($deploy) == 'Olssonm\Deploy\Deploy');
		$this->assertTrue($deploy->make());
		$this->assertTrue(get_class($deploy->when()) == 'Carbon\Carbon');

		// self::clean();
	}

	/**
	 * Test deploy:make command
	 * @test
	 */
	public function testCommandsVisible()
	{
		Artisan::call('');
		$output = Artisan::output();

		$test1 = false;
		$test2 = false;

		// Check that "deploy:make" and "deploy:when" are found
		if(strpos($output, 'deploy:make') !== false) {
			$test1 = true;
		}
		if(strpos($output, 'deploy:when') !== false) {
			$test2 = true;
		}

		$this->assertTrue($test1);
		$this->assertTrue($test2);
	}

	/**
	 * Test deploy:make command
	 * @test
	 */
	public function testDeployMakeCommand($value='')
	{
		// Make sure no deploy file is available
		$this->assertFalse(file_exists(storage_path($this->file)));

		// Run the command
		Artisan::call('deploy:make');
		$output = Artisan::output();

		// Check the output
		$test = false;
		if(strpos($output, 'Deployed @') !== false) {
			$test = true;
		}
		$this->assertTrue($test);

		// Check that the file is now available
		$this->assertTrue(file_exists(storage_path($this->file)));
	}

	/**
	 * Test deploy:when command
	 * @test
	 */
	public function testDeployWhenCommand()
	{
		Artisan::call('deploy:when');
		$output = Artisan::output();

		$test = false;
		if(strpos($output, 'Last deploy occurred @') !== false) {
			$test = true;
		}

		$this->assertTrue($test);
	}

	/**
	 * Tear down
	 */
	public function tearDown()
	{
		//
	}

	/**
	 * Tear down and remove files
	 */
	public static function tearDownAfterClass()
	{
		// self::clean();
		parent::tearDownAfterClass();
	}

	/**
	 * Cleanup generated files
	 */
	private static function clean()
	{
		unlink(storage_path('app/deploy.txt'));
	}
}
