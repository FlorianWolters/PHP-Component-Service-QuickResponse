<?php
namespace FlorianWolters\Component\Service\QuickResponse;

use \InvalidArgumentException;

/**
 * Thrown when an application attempts to use an unknown input encoding or
 * result encoding for a Quick Response (QR) code.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 * @see       QrEncodingEnum
 */
class UnknownEncodingException extends InvalidArgumentException
{
}
