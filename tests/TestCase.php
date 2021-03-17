<?php


namespace KiranAjudiya\laravelCDN\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
//use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class TestCase extends OrchestraTestCase
{
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
