<?php
namespace Aw;

interface CurrencyConvertInterface
{
    /**
     * Converts a currency
     *
     * @param float $amount     The amount to convert in a source currency
     *
     * @return float            The converted amount into the target currency
     **/
    function convert($amount);
}
