<?php

class ToPoundsConverterServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Aw\ToPoundsConverterService
     */
    private $instance;

    public function setUp()
    {
        $this->instance = new Aw\ToPoundsConverterService;
    }

    public function tearDown()
    {
        $this->instance = null;
    }

    public function testConvertEuroCorrectly()
    {
        $expected = 0.78;

        $result = $this->instance->getExchangeRate('EUR');

        $this->assertEquals($expected, $result);
    }

    public function testConvertRandomCurrencyResultsInException()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->instance->getExchangeRate('NONEXISTENT CURRENCY');
    }
}
