<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

################################################################################
# bootstrap
################################################################################

# composer autoload
require "../../vendor/autoload.php";

# filp/whoops error handling
(new Run)->prependHandler(new PrettyPageHandler)->register();

################################################################################
# start
################################################################################

require "static.php";
require "instance.php";
