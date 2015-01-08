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
        }

        throw new \InvalidArgumentException("Unknown currency: $currency");
    }
}
