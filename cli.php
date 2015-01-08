<?php
use Symfony\Component\Console\Application;
use Ucs\TransactionReportCommand;

require_once "init.php";

$app = new Application("Test project", "1.0");

$app->add(new Aw\TransactionReportCommand);

$app->run();

