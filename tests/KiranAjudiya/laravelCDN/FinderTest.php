<?php

namespace KiranAjudiya\laravelCDN\Test;

use Illuminate\Support\Collection;
use Mockery as M;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Finder\SplFileInfo;
use KiranAjudiya\laravelCDN\Asset;
use KiranAjudiya\laravelCDN\Finder;

/**
 * Class FinderTest.
 *
 * @category Test
 *
 * @author  Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class FinderTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
    }

    public function tearDown():void
    {
        M::close();
        parent::tearDown();
    }

    public function testReadReturnCorrectDataType()
    {
        $asset_holder = new Asset();

        $asset_holder->init([
            'include' => [
                'directories' => [__DIR__],
            ],
        ]);

        $console_output = M::mock(ConsoleOutput::class);
        $console_output->shouldReceive('writeln')
            ->atLeast(1);

        $finder = new Finder($console_output);

        $result = $finder->read($asset_holder);

        try {
            assertInstanceOf(SplFileInfo::class, $result->first());
        } catch (\Exception $e) {
        }

        assertEquals($result, new Collection($result->all()));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testReadThrowsException()
    {
        $asset_holder = new Asset();

        $asset_holder->init(['include' => []]);

        $console_output = M::mock(ConsoleOutput::class);
        $console_output->shouldReceive('writeln')
            ->atLeast(1);

        $finder = new Finder($console_output);

        $finder->read($asset_holder);
    }
}
