<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use FlorianWolters\Component\Geometry\Dimension2DInterface;

/**
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 * @todo      Refactor this static class.
 * @todo      Comment class.
 */
final class ParameterFilter
{
    /**
     */
    private function __construct()
    {
    }

    /**
     * @param QrErrorCorrectionLevelEnum $errorCorrectionLevel
     *
     * @return string
     * @throws UnknownErrorCorrectionLevelException
     */
    public static function filterErrorCorrectionLevel(
        QrErrorCorrectionLevelEnum $errorCorrectionLevel
    ) {
        $result = '';

        switch ($errorCorrectionLevel) {
            case QrErrorCorrectionLevelEnum::LOW():
                $result = 'L';
                break;
            case QrErrorCorrectionLevelEnum::MEDIUM():
                $result = 'M';
                break;
            case QrErrorCorrectionLevelEnum::HIGH():
                $result = 'H';
                break;
            case QrErrorCorrectionLevelEnum::QUARTILE():
                $result = 'Q';
                break;
            default:
                throw new UnknownErrorCorrectionLevelException(
                    'The specified error correction level is not defined.'
                );
                break;
        }

        return $result;
    }

    /**
     * @param Dimension2DInterface $dimension
     *
     * @return string
     */
    public static function filterDimension(Dimension2DInterface $dimension)
    {
        return $dimension->getWidth() . 'x' . $dimension->getHeight();
    }
}
