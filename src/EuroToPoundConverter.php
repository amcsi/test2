<?php
namespace Aw;

/**
 * Service to convert from EUR to GBP. 
 */
class EuroToPoundConverter implements CurrencyConvertInterface
{
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
     * @param float $amount 
     * @access public
     * @return float
     */
    public function convert($amount)
    {
        $currency = 'EUR';

        $exchangeRate = $this->currencyConverter->getExchangeRate($currency);

        return $amount * $exchangeRate;
    }
}
