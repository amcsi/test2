<?php
namespace Aw;

/**
 * Class to generate reports of merchants  
 */
class TransactionReporter
{
    private $transactionTable;
    private $currencyConverter;

    public function __construct(
        TransactionTableInterface $transactionTable,
        CurrencyConvertInterface $currencyConverter
    ) {
        $this->transactionTable = $transactionTable;
        $this->currencyConverter = $currencyConverter;
    }

    /**
     * Returns the report string output rows for the given merchant id. 
     * 
     * @param int $id 
     * @access public
     * @return string[]
     */
    public function getReportByMerchantId($id)
    {
        $merchant = $this->transactionTable->getMerchantById($id);

        $transactionData = $merchant->getTransactions();
        
        $ret = [];

        $ret[] = "Transaction report for merchant ($id)";
        $ret[] = " ===== ";
        $ret[] = '';

        foreach ($transactionData as $row) {
            $rowText = "Transaction at $row[1]: "; // the date
            $rowText .= sprintf(
                '£%.2f',
                $this->currencyConverter->convert($row[2])
            ); // the amount

            $ret[] = $rowText;
        }

        return $ret;
    }
}
