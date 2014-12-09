<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../bootstrap/start.php';
	}

    public function setUp()
    {
        parent::setUp();

        Artisan::call("migrate");
    }

    /**
     * @param $method
     * @param $uri
     * @param array $payload
     * @param array $parameters
     * @return \Illuminate\Http\Response
     */
    protected function callJSON($method, $uri, array $payload = [], array $parameters = [])
    {
        return $this->call($method, $uri, $parameters, [] ,['Content-Type' => 'application/json'], json_encode($payload));
    }

}
