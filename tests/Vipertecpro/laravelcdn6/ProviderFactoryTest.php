<?php

namespace KiranAjudiya\laravelCDN\Test;

use Illuminate\Support\Facades\App;
use Mockery as M;
use KiranAjudiya\laravelCDN\Exceptions\MissingConfigurationException;
use KiranAjudiya\laravelCDN\ProviderFactory;
use KiranAjudiya\laravelCDN\Providers\AwsS3Provider;

/**
 * Class ProviderFactoryTest.
 *
 * @category Test
 *
 * @author  Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class ProviderFactoryTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();

        $this->provider_factory = new ProviderFactory();
    }

    public function tearDown():void
    {
        M::close();
        parent::tearDown();
    }

    public function testCreateReturnCorrectProviderObject()
    {
        $configurations = ['default' => 'AwsS3'];
        $m_aws_s3 = M::mock(AwsS3Provider::class);
        App::shouldReceive('make')->once()->andReturn($m_aws_s3);
        $m_aws_s3->shouldReceive('init')
            ->with($configurations)
            ->once()
            ->andReturn($m_aws_s3);

        $provider = $this->provider_factory->create($configurations);

        assertEquals($provider, $m_aws_s3);
    }

    /**
     * @expectedException MissingConfigurationException
     */
    public function testCreateThrowsExceptionWhenMissingDefaultConfiguration()
    {
        $configurations = ['default' => ''];

        $m_aws_s3 = M::mock(AwsS3Provider::class);

        \Illuminate\Support\Facades\App::shouldReceive('make')->once()->andReturn($m_aws_s3);

        $this->provider_factory->create($configurations);
    }
}
