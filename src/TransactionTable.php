<?php
namespace Aw;

class TransactionTable implements TransactionTableInterface
{
    /**
     * Returns all data belonging to the given merchant id
     * 
     * @param mixed $id 
     * @access public
     * @return Merchant
     */
    public function getMerchantById($id)
    {
        $file = PROJECT_ROOT . '/data/data.csv';

        $handle = fopen($file, 'r');

        if ($handle) {

            // header
            $csvArr = fgetcsv($handle);

            $data = [];

            while (!feof($handle)) {
                $csvArr = fgetcsv($handle);

                if ($csvArr[0] != $id) {
                    continue; // not the right id
                }

                // add the data to the array containing the relevant
                // row data
                $data[] = $csvArr;
            }

            fclose($handle);

            return new Merchant($data);
        }
    }

}
