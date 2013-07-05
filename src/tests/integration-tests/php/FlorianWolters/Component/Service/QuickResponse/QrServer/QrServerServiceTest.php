<?php
namespace FlorianWolters\Component\Service\QuickResponse\QrServer;

use FlorianWolters\Component\Service\QuickResponse\QrCodeParameter;

/**
 * Test class for {@see QrServerService}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 *
 * @covers    FlorianWolters\Component\Service\QuickResponse\QrServer\QrServerService
 */
class QrServerServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrServerService
     */
    private $service;

    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->service = new QrServerService;
    }

    /**
     * @return void
     *
     * @coversDefaultClass getQrCode
     * @test
     */
    public function testGetQrCode()
    {
        $qrCode = new QrCodeParameter('http://example.org');
        $actual = $this->service->getQrCode($qrCode);
        
        $this->assertInternalType('string', $actual);
    }
}
