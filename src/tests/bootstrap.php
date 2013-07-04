<?php
/**
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 */

use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Tests\GuzzleTestCase;

require_once __DIR__ . '/../../vendor/autoload.php';

$baseNamespace = 'FlorianWolters\Component\Service\QuickResponse';
$serviceBuilder = ServiceBuilder::factory(
    [
        'test.google_infographics' => [
            'class' => $baseNamespace . '\GoogleInfographics\GoogleInfographicsClient'
        ],
        'test.qr_server' => [
            'class' => $baseNamespace . '\QrServer\QrServerClient'
        ]
    ]
);
GuzzleTestCase::setServiceBuilder($serviceBuilder);
