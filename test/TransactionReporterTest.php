<?php

/**
 * Test for the TransactionReporter class.
 * That class has too many responsibilities and normally should be split
 * up into multiple classes handling several things.
 * Because it has too many responsibilities, it is difficult to test. 
 */
class TransactionReporterTest extends PHPUnit_Framework_TestCase
{
    private $instance;
    private $transactionTableMock;
    private $currencyConvertMock;

    public function setUp()
    {
        $transactionTableMock = Mockery::mock(
            'Aw\TransactionTable'
        );
        $this->transactionTableMock = $transactionTableMock;

        $currencyConvertMock = Mockery::mock(
            'Aw\CurrencyConverter'
        );
        $this->currencyConvertMock = $currencyConvertMock;

        $this->instance = new Aw\TransactionReporter(
            $transactionTableMock,
            $currencyConvertMock
        );
    }

    public function tearDown()
    {
        $this->instance = null;
    }

    public function testGetReportByMerchantId()
    {
        $merchantResult = new Aw\Merchant([
            ['1', '01/01/2015', '£100.00'],
            ['1', '02/01/2015', '€200.00'],
        ]);

        $this->transactionTableMock->shouldReceive('getMerchantById')
            ->once()
            ->with('1')
            ->andReturn($merchantResult);

        $this->currencyConvertMock->shouldReceive('convert')
            ->once()
            ->with('£100.00')
            ->andReturn('£100.00');

        $this->currencyConvertMock->shouldReceive('convert')
            ->once()
            ->with('€200.00')
            ->andReturn('£150.00'); // the exact amount returned is not important
                                    // as it is this class we are testing, not that one

        $result = $this->instance->getReportByMerchantId('1');

        $expected = [
            'Transaction report for merchant (1)',
            ' ===== ',
            '',
            'Transaction at 01/01/2015: £100.00',
            'Transaction at 02/01/2015: £150.00',
        ];

        $this->assertEquals($expected, $result);
    }
}
