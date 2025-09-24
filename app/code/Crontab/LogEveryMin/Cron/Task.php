<?php

namespace Crontab\LogEveryMin\Cron;

use Psr\Log\LoggerInterface;

/**
 * This class is executed by Magento's cron system
 * according to the schedule defined in crontab.xml.
 */
class Task
{
    /**
     * Logger is used to write to var/log/system.log or custom logs.
     */
    protected $logger;

    /**
     * Constructor to inject dependencies (e.g., logger).
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * The method defined in crontab.xml ("method=execute").
     * Magento will call this automatically based on schedule.
     */
    public function execute()
    {
        // Example: write to log file
        $this->logger->info('>>> Custom cron job executed at: ' . date('Y-m-d H:i:s'));

        // Your business logic here:
        // Example: clean old records, sync API data, update database, etc.
        // For demo, let's just simulate some task:
        $this->doSomething();

        return $this; // returning $this is optional, but common convention
    }

    /**
     * Example method with your custom logic.
     */
    protected function doSomething()
    {
        // Example: pretend to update records
        $this->logger->info('>>> Task is running custom logic...');
        //after bin/magento cron:run
        //the logs will be in var/log/system.log
    }
}
