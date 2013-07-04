<?php
namespace FlorianWolters\Component\Service\QuickResponse\QrServer;

use FlorianWolters\Component\Service\QuickResponse\QuickResponseClientTestAbstract;

/**
 * Test class for {@see GoogleInfographicsClient}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
  *
 * @covers    FlorianWolters\Component\Service\QuickResponse\GoogleInfographics\GoogleInfographicsClient
 * @covers    FlorianWolters\Component\Service\WebServiceClientAbstract
 */
class GoogleInfographicsClientTest extends QuickResponseClientTestAbstract
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
            __DIR__ . '/../../../../../../mocks/binary/GoogleInfographics'
        );
        $this->client = $this->getServiceBuilder()->get(
            'test.google_infographics'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function executeGetQrCode()
    {
        $command = $this->client->getCommand(
            'GetQrCode',
            [
                'cht' => 'qr',
                'chl' => 'Example',
                'chs' => '200x200'
            ]
        );

        $command->prepare();

        $this->assertRequestUrl(
            'https://chart.googleapis.com/chart?cht=qr&chl=Example&chs=200x200',
            $command
        );
        $this->assertRequestMethod('GET', $command);

        $command->execute();

        $this->assertResultStatusCode(200, $command);
        $this->assertResultContentLength(912, $command);
        $this->assertResponseHeaderContentType('image/png', $command);
        $this->assertResponseBodyContentMd5(
            'c2d95e80a1d5f7fe1548ecca7d31557d',
            $command
        );
    }
}
