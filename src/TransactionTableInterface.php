<?php
namespace Aw;

interface TransactionTableInterface
{
    /**
     * Gets all transaction data by id 
     * 
     * @param int $id 
     * @access public
     * @return Merchant
     */
    function getMerchantById($id);
}
