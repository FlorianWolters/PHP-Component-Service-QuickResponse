<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The enumeration class {@see QrErrorCorrectionLevelEnum} enumerates the Error
 * Correction (EC) levels for a Quick Response (QR) code.
 *
 * QR uses *Read-Solomon (RS)* codes.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
final class QrErrorCorrectionLevelEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The Error Correction (EC) level *Low* (L).
     *
     * @return QrErrorCorrectionLevelEnum The EC level.
     */
    public static function LOW()
    {
        return self::getInstance();
    }

    /**
     * The Error Correction (EC) level *Medium* (M).
     *
     * @return QrErrorCorrectionLevelEnum The EC level.
     */
    public static function MEDIUM()
    {
        return self::getInstance();
    }

    /**
     * The Error Correction (EC) level *Quartile* (Q).
     *
     * @return QrErrorCorrectionLevelEnum The EC level.
     */
    public static function QUARTILE()
    {
        return self::getInstance();
    }

    /**
     * The Error Correction (EC) level *High* (H).
     *
     * @return QrErrorCorrectionLevelEnum The EC level.
     */
    public static function HIGH()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
