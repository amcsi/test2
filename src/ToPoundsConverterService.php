<?php
namespace Aw;

class ToPoundsConverterService implements CurrencyConverterServiceInterface
{

    public function getExchangeRate($currency)
    {
        // dummy webservice
        switch ($currency) {
            case 'EUR':
                return 0.78; // 1 euro is equal to 0.78 pounds
            case 'USD':
                return 0.66; // 1 dollar is equal to 0.66 pounds
            case 'GBP':
                return 1.0; // no conversion.
        }

        throw new \InvalidArgumentException("Unknown currency: $currency");
    }
}
