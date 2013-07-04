<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The enumeration class {@see QrImageFileFormatEnum} enumerates the image file
 * formats for a Quick Response (QR) code.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
final class QrImageFileFormatEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The file type *GIF*.
     *
     * @return QrImageFileFormatEnum The file type.
     */
    public static function GIF()
    {
        return self::getInstance();
    }

    /**
     * The file type *JPEG*.
     *
     * @return QrImageFileFormatEnum The file type.
     */
    public static function JPEG()
    {
        return self::getInstance();
    }

    /**
     * The file type *PNG*.
     *
     * @return QrImageFileFormatEnum The file type.
     */
    public static function PNG()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
