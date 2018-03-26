<?php

use App\DBH;

require __DIR__ . "/../../vendor/autoload.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(DBH::get());
