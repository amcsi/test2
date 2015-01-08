<?php
namespace Aw;

/**
 * Class containing all the transactions belonging to a merchant 
 */
class Merchant
{
    private $data;

    public function __construct(
        array $data
    ) {
        $this->data = $data;
    }

    /**
     * Returns all the transaction data belonging to the merchant in its
     * raw csv (db) result format
     * 
     * @access public
     * @return array
     */
    public function getTransactions()
    {
        return $this->data;
    }
}
