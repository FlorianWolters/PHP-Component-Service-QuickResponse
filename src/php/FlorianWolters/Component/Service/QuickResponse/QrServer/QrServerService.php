<?php
namespace FlorianWolters\Component\Service\QuickResponse\QrServer;

use FlorianWolters\Component\Core\StringUtils;
use FlorianWolters\Component\Drawing\Color\ColorInterface;
use FlorianWolters\Component\Service\QuickResponse\ParameterFilter;
use FlorianWolters\Component\Service\QuickResponse\QrEncodingEnum;
use FlorianWolters\Component\Service\QuickResponse\QrImageFileFormatEnum;
use FlorianWolters\Component\Service\QuickResponse\QrCodeParameter;
use FlorianWolters\Component\Service\QuickResponse\QrServiceInterface;
use FlorianWolters\Component\Service\QuickResponse\UnknownEncodingException;
use FlorianWolters\Component\Service\QuickResponse\UnknownImageFileFormatException;

/**
 * The class {@see QrServerService} implements a service which
 * consumes the web service client the {@link QR-Code-API
 * http://qrserver.com/api}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 * @see       QrServerClient
 */
class QrServerService implements QrServiceInterface
{
    /**
     * The web service client to use.
     *
     * @var QrServerClient
     */
    private $client;

    /**
     * Constructs a new {@see QrServerService} with the specified {@see
     * QrServerClient}.
     *
     * If no {@see QrServerClient} is specified, the {@see QrServerClient} is
     * obtained from its *Factory Method*.
     *
     * @param QrServerClient|null $client The web service client to use.
     */
    public function __construct(QrServerClient $client = null)
    {
        $this->client = (null === $client)
            ? QrServerClient::factory()
            : $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getQrCode(QrCodeParameter $qrCode)
    {
        $commandName = 'GetQrCode';
        $commandArguments = [
            'data' => $qrCode->getInputData(),
            'size' => ParameterFilter::filterDimension($qrCode->getDimension()),
            'charset-source' => $this->filterEncoding($qrCode->getInputEncoding()),
            'charset-target' => $this->filterEncoding($qrCode->getOutputEncoding()),
            'ecc' => ParameterFilter::filterErrorCorrectionLevel($qrCode->getErrorCorrectionLevel()),
            'color' => $this->filterColor($qrCode->getDataColor()),
            'bgcolor' => $this->filterColor($qrCode->getBackgroundColor()),
            'margin' => $qrCode->getMargin(),
            'qzone' => $qrCode->getQuietZone(),
            'format' => $this->filterImageFileFormat($qrCode->getImageFileFormat())
        ];

        $command = $this->client->getCommand($commandName, $commandArguments);
        $command->execute();

        return $command->getResponse()->getBody(true);
    }

    private function filterColor(ColorInterface $color)
    {
        return StringUtils::removeStart($color->toHtmlString(), '#');
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
            default:
                throw new UnknownEncodingException;
                break;
        }

        return $result;
    }

    private function filterImageFileFormat(
        QrImageFileFormatEnum $imageFileFormat
    ) {
        $result = '';

        switch ($imageFileFormat) {
            case QrImageFileFormatEnum::PNG():
                $result = 'png';
                break;
            case QrImageFileFormatEnum::JPEG():
                $result = 'jpeg';
                break;
            case QrImageFileFormatEnum::GIF():
                $result = 'gif';
                break;
            default:
                throw new UnknownImageFileFormatException;
                break;
        }

        return $result;
    }
}
