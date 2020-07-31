<?php

declare(strict_types=1);

use cbenco\TimestampGenerator\Web;

require_once 'vendor/autoload.php';

echo (new Web())->index();
