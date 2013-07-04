<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use Guzzle\Service\Command\AbstractCommand;
use Guzzle\Tests\GuzzleTestCase;

/**
 * The abstract class {@see QuickResponseClientTestAbstract} is the base class
 * for all web service clients that use a Quick Response (QR) API.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
abstract class QuickResponseClientTestAbstract extends GuzzleTestCase
{
    /**
     * The web service client.
     *
     * @var WebServiceClientAbstract
     */
    protected $client;

    /**
     * @return void
     *
     * @group internet
     * @test
     */
    public function testGetQrCodeOnline()
    {
        $this->executeGetQrCode();
    }

    abstract protected function executeGetQrCode();

    /**
     * @return void
     *
     * @test
     */
    public function testGetQrCodeOffline()
    {
        $this->setMockResponse($this->client, 'GetQrCode.dmp');
        $this->executeGetQrCode();
    }

    // TODO Create a utility class to offer assertions for Guzzle.

    protected function assertRequestUrl($expected, AbstractCommand $command)
    {
        $this->assertEquals(
            $expected,
            $command->getRequest()->getUrl()
        );
    }

    protected function assertRequestMethod($expected, AbstractCommand $command)
    {
        $this->assertEquals(
            $expected,
            $command->getRequest()->getMethod()
        );
    }

    protected function assertResultStatusCode($expected, AbstractCommand $command)
    {
        $this->assertEquals($expected, $command->getResult()->getStatusCode());
    }

    protected function assertResultContentLength($expected, AbstractCommand $command)
    {
        $this->assertEquals($expected, $command->getResult()->getContentLength());
    }

    // TODO This seems to go to far. 
    protected function assertResponseHeaderContentType($expected, AbstractCommand $command)
    {
        $this->assertEquals(
            $expected,
            $command->getResponse()->getHeader('Content-Type')
        );
    }

    protected function assertResponseBodyContentMd5($expected, AbstractCommand $command)
    {
        $this->assertEquals(
            $expected,
            $command->getResponse()->getBody()->getContentMd5()
        );
    }
}
