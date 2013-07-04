<?php
namespace FlorianWolters\Component\Service\QuickResponse;

/**
 * The interface {@see QrServiceInterface} can be implemented by a class which
 * is able to create a Quick Response (QR) code as a binary string.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
interface QrServiceInterface
{
    /**
     * Gets a Quick Response (QR) code for the specified {@see QrCodeParameter}
     * object.
     *
     * @param QrCodeParameter $qrCode The parameters for the QR code to create.
     *
     * @return string The QR code as a binary string.
     */
    public function getQrCode(QrCodeParameter $qrCode);
}
