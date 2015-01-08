<?php

class CurrencyConverterText extends PHPUnit_Framework_TestCase
{
    /**
     * @var Aw\EuroToPoundConverter
     */
    private $instance;

    /**
     * @var Aw\CurrencyConverterServiceInterface
     */
    private $currencyConverterServiceMock;

    public function setUp()
    {
        $currencyConverterServiceMock = Mockery::mock(
            'Aw\CurrencyConverterServiceInterface'
        );

        $this->currencyConverterServiceMock = $currencyConverterServiceMock;

        $this->instance = new Aw\CurrencyConverter($currencyConverterServiceMock);
    }

    public function tearDown()
    {
        $this->instance = null;
    }

    public function testConvert1()
    {
        $input = '€1.00'; // 1 EUR

        $expected = 0.78; // 0.78 pounds

        $this->currencyConverterServiceMock->shouldReceive('getExchangeRate')
            ->once()
            ->with('EUR')
            ->andReturn(0.78);

        $result = $this->instance->convert($input);

        $this->assertEquals($expected, $result);
    }

    public function testConvert100()
    {
        $input = '€100.00'; // 100 EUR

        $expected = 78; // 78 pounds

        $this->currencyConverterServiceMock->shouldReceive('getExchangeRate')
            ->once()
            ->with('EUR')
            ->andReturn(0.78);

        $result = $this->instance->convert($input);

        $this->assertEquals($expected, $result);
    }
}
