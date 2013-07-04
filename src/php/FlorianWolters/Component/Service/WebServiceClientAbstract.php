<?php
namespace FlorianWolters\Component\Service;

use \ReflectionClass;

use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * The abstract class {@see WebServiceClientAbstract} is the base class for all
 * web service clients.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */
abstract class WebServiceClientAbstract extends Client
{
    /**
     * {@inheritdoc}
     */
    public static function factory($config = [])
    {
        $client = new static;
        $client->createAndSetServiceDescription();

        return $client;
    }

    /**
     * Creates and sets the {@see ServiceDescription} for this web service
     * client.
     *
     * The service description file must be stored in the same directory as the
     * concrete web service class and must have the filename `service.json`.
     *
     * @return void
     */
    private function createAndSetServiceDescription()
    {
        $description = ServiceDescription::factory(
            $this->directoryNameForCallingClass() . '/service.json'
        );
        $this->setDescription($description);
    }

    /**
     * Retrieves the name of the directory for the calling class.
     *
     * @return string
     */
    private function directoryNameForCallingClass()
    {
        $reflectedClass = new ReflectionClass(\get_class($this));
        $result = \dirname($reflectedClass->getFileName());

        return $result;
    }
}
