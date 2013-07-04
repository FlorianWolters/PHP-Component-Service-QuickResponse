<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The enumeration class {@see QrEncodingEnum} enumerates the input and result
 * encodings for a Quick Response (QR) code.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
final class QrEncodingEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The encoding *UTF-8*.
     *
     * @return QrEncodingEnum The encoding.
     */
    public static function UTF_8()
    {
        return self::getInstance();
    }

    /**
     * The encoding *Shift_JIS*.
     *
     * @return QrEncodingEnum The encoding.
     */
    public static function SHIFT_JIS()
    {
        return self::getInstance();
    }

    /**
     * The encoding *ISO-8859-1*.
     *
     * @return QrEncodingEnum The encoding.
     */
    public static function ISO_8859_1()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
