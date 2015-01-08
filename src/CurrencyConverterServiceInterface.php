<?php
namespace Aw;

interface CurrencyConverterServiceInterface
{
    /**
     * Returns the exchange rate of the given currency
     * 
     * @param string $currency      The ISO 4217 code of the currency to convert
     * @access public
     * @return float                The exchange rate of the currency
     */
    function getExchangeRate($currency);
}
