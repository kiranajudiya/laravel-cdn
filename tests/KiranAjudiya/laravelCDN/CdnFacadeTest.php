<?php

namespace KiranAjudiya\laravelCDN\Test;

use Mockery as M;
use KiranAjudiya\laravelCDN\CdnFacade;
use KiranAjudiya\laravelCDN\Providers\AwsS3Provider;
use KiranAjudiya\laravelCDN\Contracts\ProviderFactoryInterface;
use KiranAjudiya\laravelCDN\Validators\CdnFacadeValidator;
use KiranAjudiya\laravelCDN\Contracts\CdnHelperInterface;

/**
 * Class CdnFacadeTest.
 *
 * @category Test
 *
 * @author   Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class CdnFacadeTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();

        $configuration_file = [
            'bypass'    => false,
            'default'   => 'AwsS3',
            'url'       => 'https://s3.amazonaws.com',
            'threshold' => 10,
            'providers' => [
                'aws' => [
                    's3' => [
                        'region'      => 'rrrrrrrrrrrgggggggggnnnnn',
                        'version'     => 'vvvvvvvvssssssssssnnnnnnn',
                        'buckets'     => [
                            'bbbuuuucccctttt' => '*',
                        ],
                        'acl'         => 'public-read',
                        'cloudfront'  => [
                            'use'     => false,
                            'cdn_url' => '',
                        ],
                        'version'     => '1',
                    ],
                ],
            ],
            'include'   => [
                'directories' => [__DIR__],
                'extensions'  => [],
                'patterns'    => [],
            ],
            'exclude'   => [
                'directories' => [],
                'files'       => [],
                'extensions'  => [],
                'patterns'    => [],
                'hidden'      => true,
            ],
        ];

        $this->asset_path = 'foo/bar.php';
        $this->path_path = 'public/foo/bar.php';
        $this->asset_url = 'https://bucket.s3.amazonaws.com/public/foo/bar.php';

        $this->provider = M::mock(AwsS3Provider::class);

        $this->provider_factory = M::mock(ProviderFactoryInterface::class);
        $this->provider_factory->shouldReceive('create')->once()->andReturn($this->provider);

        $this->helper = M::mock(CdnHelperInterface::class);
        $this->helper->shouldReceive('getConfigurations')->once()->andReturn($configuration_file);
        $this->helper->shouldReceive('cleanPath')->andReturn($this->asset_path);
        $this->helper->shouldReceive('startsWith')->andReturn(true);

        $this->validator = new CdnFacadeValidator();

        $this->facade = new CdnFacade(
            $this->provider_factory, $this->helper, $this->validator);
    }

    public function tearDown():void
    {
        M::close();
        parent::tearDown();
    }

    public function testAssetIsCallingUrlGenerator()
    {
        $this->provider->shouldReceive('urlGenerator')
                       ->once()
                       ->andReturn($this->asset_url);

        $result = $this->facade->asset($this->asset_path);
        // assert is calling the url generator
        assertEquals($result, $this->asset_url);
    }

    public function testPathIsCallingUrlGenerator()
    {
        $this->provider->shouldReceive('urlGenerator')
                       ->once()
                       ->andReturn($this->asset_url);

        $result = $this->facade->asset($this->path_path);
        // assert is calling the url generator
        assertEquals($result, $this->asset_url);
    }

    /**
     * @expectedException \KiranAjudiya\laravelCDN\Exceptions\EmptyPathException
     */
    public function testUrlGeneratorThrowsException()
    {
        $this->invokeMethod($this->facade, 'generateUrl', [null, null]);
    }
}
