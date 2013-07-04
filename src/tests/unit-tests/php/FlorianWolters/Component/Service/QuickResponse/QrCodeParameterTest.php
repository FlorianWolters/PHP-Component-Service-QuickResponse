<?php
namespace FlorianWolters\Component\Service\QuickResponse;

/**
 * Test class  for {@see QrCodeParameter}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Service-QuickResponse
 *
 * @covers    FlorianWolters\Component\Service\QuickResponse\QrCodeParameter
 */
class QrCodeParameterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The {@see QrCodeParameter} under test.
     *
     * @var QrCodeParameter
     */
    private $qrCodeParameter;

    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $inputData = 'http://example.org';
        $dimension = $this->getMock('FlorianWolters\Component\Geometry\Dimension2DInterface');

        // I can't see a solution for mocking enumeration constants since the component uses a lot of reflection.
        // Therefore I look at enumerations as a well-tested "language feature".
        $inputEncoding = QrEncodingEnum::UTF_8();
        $errorCorrectionLevel = QrErrorCorrectionLevelEnum::LOW();
        $quietZone = 4;
        $margin = 1;
        $this->dataColor = $this->getMock('FlorianWolters\Component\Drawing\Color\ColorInterface');
        $this->backgroundColor = $this->getMock('FlorianWolters\Component\Drawing\Color\ColorInterface');
        $imageFileFormat = QrImageFileFormatEnum::PNG();
        $resultEncoding = QrEncodingEnum::UTF_8();

        $this->qrCodeParameter = new QrCodeParameter(
            $inputData,
            $dimension,
            $inputEncoding,
            $errorCorrectionLevel,
            $quietZone,
            $margin,
            $this->dataColor,
            $this->backgroundColor,
            $imageFileFormat,
            $resultEncoding
        );
    }

    /**
     * @return void
     *
     * @coversDefaultClass __construct
     * @test
     */
    public function testConstructorDefaultArgumentValues()
    {
        $qrCodeParameter = new QrCodeParameter('.');

        $this->assertInstanceOf(
            'FlorianWolters\Component\Geometry\Dimension2DInterface',
            $qrCodeParameter->getDimension()
        );
        $this->assertEquals(
            QrEncodingEnum::UTF_8(),
            $qrCodeParameter->getInputEncoding()
        );
        $this->assertEquals(
            QrErrorCorrectionLevelEnum::LOW(),
            $qrCodeParameter->getErrorCorrectionLevel()
        );
        $this->assertEquals(
            QrEncodingEnum::UTF_8(),
            $qrCodeParameter->getOutputEncoding()
        );
    }

    /**
     * @return void
     *
     * @coversDefaultClass getInputData
     * @test
     */
    public function testGetInputData()
    {
        $expected = 'http://example.org';
        $actual = $this->qrCodeParameter->getInputData();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getDimension
     * @test
     */
    public function testGetDimension()
    {
        $expected = $this->getMock('FlorianWolters\Component\Geometry\Dimension2DInterface');
        $actual = $this->qrCodeParameter->getDimension();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getInputEncoding
     * @test
     */
    public function testGetInputEncoding()
    {
        $expected = QrEncodingEnum::UTF_8();
        $actual = $this->qrCodeParameter->getInputEncoding();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getErrorCorrectionLevel
     * @test
     */
    public function testGetErrorCorrectionLevel()
    {
        $expected = QrErrorCorrectionLevelEnum::LOW();
        $actual = $this->qrCodeParameter->getErrorCorrectionLevel();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getQuietZone
     * @test
     */
    public function testGetQuietZone()
    {
        $expected = 4;
        $actual = $this->qrCodeParameter->getQuietZone();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getMargin
     * @test
     */
    public function testGetMargin()
    {
        $expected = 1;
        $actual = $this->qrCodeParameter->getMargin();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getDataColor
     * @test
     */
    public function testGetDataColor()
    {
        $expected = $this->dataColor;
        $actual = $this->qrCodeParameter->getDataColor();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getBackgroundColor
     * @test
     */
    public function testGetBackgroundColor()
    {
        $expected = $this->backgroundColor;
        $actual = $this->qrCodeParameter->getBackgroundColor();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getImageFileFormat
     * @test
     */
    public function testGetImageFileFormat()
    {
        $expected = QrImageFileFormatEnum::PNG();
        $actual = $this->qrCodeParameter->getImageFileFormat();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass getOutputEncoding
     * @test
     */
    public function testGetOutputEncoding()
    {
        $expected = QrEncodingEnum::UTF_8();
        $actual = $this->qrCodeParameter->getOutputEncoding();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass __construct
     * @coversDefaultClass setInputData
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The input data for the QrCodeParameter is invalid.
     * @test
     */
    public function testConstructorThrowsInvalidArgumentExceptionIfInputDataIsInvalid()
    {
        new QrCodeParameter(null);
    }

    /**
     * @return void
     *
     * @coversDefaultClass __construct
     * @coversDefaultClass setQuietZone
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The quiet zone for the QrCodeParameter is invalid.
     * @test
     */
    public function testConstructorThrowsInvalidArgumentExceptionIfQuietZoneIsInvalid()
    {
        new QrCodeParameter('foo', null, null, null, null);
    }

    /**
     * @return void
     *
     * @coversDefaultClass __construct
     * @coversDefaultClass setMargin
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The margin for the QrCodeParameter is invalid.
     * @test
     */
    public function testConstructorThrowsInvalidArgumentExceptionIfMarginIsInvalid()
    {
        new QrCodeParameter('foo', null, null, null, 4, null);
    }
}
