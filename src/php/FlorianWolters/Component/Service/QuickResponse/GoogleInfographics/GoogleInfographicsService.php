<?php
namespace FlorianWolters\Component\Service\QuickResponse\GoogleInfographics;

use FlorianWolters\Component\Service\QuickResponse\ParameterFilter;
use FlorianWolters\Component\Service\QuickResponse\QrCodeParameter;
use FlorianWolters\Component\Service\QuickResponse\QrEncodingEnum;
use FlorianWolters\Component\Service\QuickResponse\QrServiceInterface;
use FlorianWolters\Component\Service\QuickResponse\UnknownEncodingException;

/**
 * The class {@see GoogleInfographicsService} implements a service which
 * consumes the web service client for the {@link Google Infographics
 * Application Programming Interface (API)
 * https://google-developers.appspot.com/chart/infographics}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 * @see       GoogleInfographicsClient
 */
class GoogleInfographicsService implements QrServiceInterface
{
    /**
     * The web service client to use.
     *
     * @var GoogleInfographicsClient
     */
    private $client;

    /**
     * Constructs a new {@see GoogleInfographicsService} with the specified
     * {@see GoogleInfographicsClient}.
     *
     * If no {@see GoogleInfographicsClient} is specified, the {@see
     * GoogleInfographicsClient} is obtained from its *Factory Method*.
     *
     * @param GoogleInfographicsClient|null $client The web service client to
     *                                              use.
     */
    public function __construct(GoogleInfographicsClient $client = null)
    {
        $this->client = (null === $client)
            ? GoogleInfographicsClient::factory()
            : $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getQrCode(QrCodeParameter $qrCode)
    {
        $commandName = 'GetQrCode';
        $commandArguments = [
            'chl' => $qrCode->getInputData(),
            'chs' => ParameterFilter::filterDimension($qrCode->getDimension()),
            'choe' => $this->filterEncoding($qrCode->getInputEncoding()),
            'chld' => ParameterFilter::filterErrorCorrectionLevel($qrCode->getErrorCorrectionLevel()) . '|' . $qrCode->getQuietZone()
        ];
        $command = $this->client->getCommand($commandName, $commandArguments);
        $command->execute();

        return $command->getResponse()->getBody(true);
    }

    private function filterEncoding(QrEncodingEnum $encoding)
    {
        $result = '';

        switch ($encoding) {
            case QrEncodingEnum::UTF_8():
                $result = 'UTF-8';
                break;
            case QrEncodingEnum::ISO_8859_1():
                $result = 'ISO-8859-1';
                break;
            case QrEncodingEnum::SHIFT_JIS():
                $result = 'Shift_JIS';
                break;
            default:
                throw new UnknownEncodingException;
                break;
        }

        return $result;
    }
}
