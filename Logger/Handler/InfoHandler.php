<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Logger\Handler;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger as MonologLogger;

class InfoHandler extends BaseHandler
{
    /**
     * Logging level.
     *
     * @var int
     */
    protected $loggerType = MonologLogger::INFO;

    /**
     * Log file name.
     *
     * @var string
     */
    protected $fileName = '/var/log/klar/info.log';
}
