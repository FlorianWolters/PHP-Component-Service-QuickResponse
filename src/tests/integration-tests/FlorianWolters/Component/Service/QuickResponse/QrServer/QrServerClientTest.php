<?php
namespace FlorianWolters\Component\Service\QuickResponse\QrServer;

use FlorianWolters\Component\Service\QuickResponse\QuickResponseClientTestAbstract;

/**
 * Test class for {@see QrServerClient}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 *
 * @covers    FlorianWolters\Component\Service\QuickResponse\QrServer\QrServerClient
 * @covers    FlorianWolters\Component\Service\WebServiceClientAbstract
 */
class QrServerClientTest extends QuickResponseClientTestAbstract
{
    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->setMockBasePath(
            __DIR__ . '/../../../../../../mocks/binary/QrServer'
        );
        $this->client = $this->getServiceBuilder()->get(
            'test.qr_server'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function executeGetQrCode()
    {
        $command = $this->client->getCommand(
            'GetQrCode',
            ['data' => 'Example']
        );

        $command->prepare();

        $this->assertRequestUrl(
            'http://api.qrserver.com/v1/create-qr-code/?data=Example',
            $command
        );
        $this->assertRequestMethod('GET', $command);

        $command->execute();

        $this->assertResultStatusCode(200, $command);
        $this->assertResultContentLength(366, $command);
        $this->assertResponseHeaderContentType('image/png', $command);
        $this->assertResponseBodyContentMd5(
            '3a1a15eec81c023b7e0fbbd4830e0085',
            $command
        );
    }
}
