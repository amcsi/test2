<?php
namespace Aw;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class TransactionReportCommand extends Command
{
    protected function configure()
    {
        return $this->setName('get-report-by-id')
            ->setDescription("Shows the dates of Mid Month Meeting and End of Month Testing for the next 6 months in CSV format.")
            ->addArgument('merchant-id', InputArgument::OPTIONAL, 'Which merchant id to report about?')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $merchantId = $input->getArgument('merchant-id');
        if (!$merchantId) {
            $output->writeln("Please provide a merchant id.");

            exit(1);
        }

        $toPoundsConverterService = new ToPoundsConverterService;
        $currencyConverter = new CurrencyConverter($toPoundsConverterService);

        $transactionTable = new TransactionTable;

        $transactionReporter = new TransactionReporter(
            $transactionTable,
            $currencyConverter
        );

        $outputRows = $transactionReporter->getReportByMerchantId($merchantId);

        foreach ($outputRows as $outputRow) {
            $output->writeln($outputRow);
        }

        exit (0);
    }
}

