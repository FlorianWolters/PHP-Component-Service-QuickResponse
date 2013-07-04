<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use \InvalidArgumentException;

use FlorianWolters\Component\Core\EqualityInterface;
use FlorianWolters\Component\Core\ImmutableInterface;
use FlorianWolters\Component\Core\ValueObjectTrait;
use FlorianWolters\Component\Drawing\Color\ColorInterface;
use FlorianWolters\Component\Drawing\Color\RgbaColor;
use FlorianWolters\Component\Geometry\Dimension2DInterface;
use FlorianWolters\Component\Geometry\Dimension2D;

/**
 * The class {@see QrCodeParameter} wraps the parameters of a Quick Response
 * (QR) code into an object.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
class QrCodeParameter implements
    EqualityInterface,
    ImmutableInterface
{
    use ValueObjectTrait { __construct as constructImmutableTrait; }

    /**
     * The input data for the QR code.
     *
     * @var string
     */
    private $inputData;

    /**
     * The dimension of the QR code.
     *
     * @var Dimension2DInterface
     */
    private $dimension;

    /**
     * The encoding of the input data for the QR code.
     *
     * @var QrEncodingEnum
     */
    private $inputEncoding;

    /**
     * The Error Correction (EC) level of the QR code.
     *
     * @var QrErrorCorrectionLevelEnum
     */
    private $errorCorrectionLevel;

    /**
     * The *quiet zone* of the QR code.
     *
     * @var integer
     */
    private $quietZone;

    /**
     * The margin of the QR code.
     *
     * @var integer
     */
    private $margin;

    /**
     * The {@see Color} for the data elements of the QR code.
     *
     * @var Color
     */
    private $dataColor;

    /**
     * The {@see Color} for the background of the QR code.
     *
     * @var Color
     */
    private $backgroundColor;

    /**
     * The graphics file format of the QR code.
     *
     * @var QrImageFileFormatEnum
     */
    private $imageFileFormat;

    /**
     * The encoding of the output data for the QR code.
     *
     * @var QrEncodingEnum
     */
    private $outputEncoding;

    /**
     * Constructs a new {@see QrCodeParameter}.
     *
     * @param string                          $inputData
     * @param Dimension2DInterface|null       $dimension
     * @param QrEncodingEnum|null             $dataEncoding
     * @param QrErrorCorrectionLevelEnum|null $errorCorrectionLevel
     * @param integer                         $quietZone
     * @param integer                         $margin
     * @param ColorInterface|null             $dataColor
     * @param ColorInterface|null             $backgroundColor
     * @param QrImageFileFormatEnum|null      $imageFileFormat
     * @param QrEncodingEnum|null             $resultEncoding
     */
    public function __construct(
        $inputData,
        Dimension2DInterface $dimension = null,
        QrEncodingEnum $inputEncoding = null,
        QrErrorCorrectionLevelEnum $errorCorrectionLevel = null,
        $quietZone = 4,
        $margin = 1,
        ColorInterface $dataColor = null,
        ColorInterface $backgroundColor = null,
        QrImageFileFormatEnum $imageFileFormat = null,
        QrEncodingEnum $outputEncoding = null
    ) {
        $this->constructImmutableTrait();

        $this->setInputData($inputData);
        $this->dimension = (null === $dimension)
            ? new Dimension2D(200, 200)
            : $dimension;
        $this->inputEncoding = (null === $inputEncoding)
            ? QrEncodingEnum::UTF_8()
            : $inputEncoding;
        $this->errorCorrectionLevel = (null === $errorCorrectionLevel)
            ? QrErrorCorrectionLevelEnum::LOW()
            : $errorCorrectionLevel;
        $this->setQuietZone($quietZone);
        $this->setMargin($margin);
        $this->dataColor = (null === $dataColor)
            ? RgbaColor::createFromComponents(0, 0, 0)
            : $dataColor;
        $this->backgroundColor = (null === $backgroundColor)
            ? RgbaColor::createFromComponents(0xFF, 0xFF, 0xFF)
            : $backgroundColor;
        $this->imageFileFormat = (null === $imageFileFormat)
            ? QrImageFileFormatEnum::PNG()
            : $imageFileFormat;
        $this->outputEncoding = (null === $outputEncoding)
            ? QrEncodingEnum::UTF_8()
            : $outputEncoding;
    }

    /**
     * @param string $inputData
     *
     * @return void
     * @throws InvalidArgumentException
     */
    private function setInputData($inputData)
    {
        if (false === \is_string($inputData) || '' === $inputData) {
            throw new InvalidArgumentException(
                'The input data for the QrCodeParameter is invalid.'
            );
        }

        $this->inputData = \urlencode($inputData);
    }

    /**
     * @param integer $quietZone
     *
     * @return void
     * @throws InvalidArgumentException
     */
    private function setQuietZone($quietZone)
    {
        if (false === \is_int($quietZone)
            || ($quietZone < 0)
            || ($quietZone > 100)
        ) {
            throw new InvalidArgumentException(
                'The quiet zone for the QrCodeParameter is invalid.'
            );
        }

        $this->quietZone = $quietZone;
    }

    /**
     * @param integer $margin
     *
     * @return void
     * @throws InvalidArgumentException
     */
    private function setMargin($margin)
    {
        if (false === \is_int($margin) || ($margin < 0) || ($margin > 50)) {
            throw new InvalidArgumentException(
                'The margin for the QrCodeParameter is invalid.'
            );
        }

        $this->margin = $margin;
    }

    /**
     * @return string
     */
    public function getInputData()
    {
        return $this->inputData;
    }

    /**
     * Returns the dimension of this {@see QrCodeParameter}.
     *
     * @return Dimension2DInterface The dimension.
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @return QrEncodingEnum
     */
    public function getInputEncoding()
    {
        return $this->inputEncoding;
    }

    /**
     * @return QrErrorCorrectionLevelEnum
     */
    public function getErrorCorrectionLevel()
    {
        return $this->errorCorrectionLevel;
    }

    /**
     * @return integer
     */
    public function getQuietZone()
    {
        return $this->quietZone;
    }

    /**
     * @return integer
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * @return Color
     */
    public function getDataColor()
    {
        return $this->dataColor;
    }

    /**
     * @return Color
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @return string
     */
    public function getImageFileFormat()
    {
        return $this->imageFileFormat;
    }

    /**
     * @return QrEncodingEnum
     */
    public function getOutputEncoding()
    {
        return $this->outputEncoding;
    }
}
