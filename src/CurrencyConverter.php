<?php
namespace Aw;

/**
 * Service to convert currency to GBP. 
 */
class CurrencyConverter implements CurrencyConvertInterface
{
    /**
     * Contains the mapping of currency symbols to ISO 4217 code 
     * 
     * @var mixed
     * @access private
     */
    private $currencyIsoMap = [
        '$' => 'USD',
        '€' => 'EUR',
        '£' => 'GBP',
    ];
    
    /**
     * @var CurrencyConverterServiceInterface
     */
    private $currencyConverter;

    public function __construct(
        CurrencyConverterServiceInterface $currencyConverter
    ) {
        $this->currencyConverter = $currencyConverter;
    }

    /**
     * Converts the given amount of EUR to GBP;
     * 
     * @param string $amount        The amount of money starting with the
     *                              currency symbol and followed by the
     *                              actual amount in numbers
     * @access public
     * @return float
     */
    public function convert($amount)
    {
        // separate the currency symbol from the amount
        preg_match('@([^\d]*)([\d\.]+)@', $amount, $matches);

        $currencySymbol = $matches[1];
        $numberAmount = $matches[2];

        $currencyIso = $this->currencyIsoMap[$currencySymbol];

        $exchangeRate = $this->currencyConverter->getExchangeRate($currencyIso);

        return $numberAmount * $exchangeRate;
    }
}
