<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Command;

use ICT\Klar\Queue\OrderPublisher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ICT\Klar\Model\Api;

class Order extends Command
{
    const IDS_PARAM = 'ids';
    const FROM_DATE_PARAM = 'from-date';

    private Api $api;
    private OrderPublisher $orderPublisher;

    /**
     * @param Api $api
     * @param OrderPublisher $orderPublisher
     * @param string|null $name
     */
    public function __construct(
        Api $api,
        OrderPublisher $orderPublisher,
        string $name = null
    ) {
        parent::__construct($name);
        $this->api = $api;
        $this->orderPublisher = $orderPublisher;
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('klar:order');
        $this->setDescription('Send specified orders to Klar');
        $this->setDefinition([
            new InputArgument(
                self::IDS_PARAM,
                InputArgument::REQUIRED,
                'Order IDs separated by comma, or "all" to send whole history'
            ),
            new InputArgument(
                self::FROM_DATE_PARAM,
                InputArgument::OPTIONAL,
                'From date to start "all" synchronization in format YYYY-MM-DD'
            ),
        ]);

        parent::configure();
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = false;
        $fromDate = null;

        $idsInput = trim($input->getArgument(self::IDS_PARAM), ' ');
        $fromInput = $input->getArgument(self::FROM_DATE_PARAM);
        if ($fromInput) {
            $fromDate = \DateTime::createFromFormat('Y-m-d', trim($fromInput, ' '));
        }

        if ($idsInput == 'all') {
            $this->orderPublisher->publish($this->orderPublisher->getAllIds($fromDate));
            $output->writeln('<info>Orders scheduled into queue successfully.</info>');
            return;
        }

        try {
            $ids = array_map('intval', explode(',', $idsInput));

            if ($ids) {
                $result = $this->api->validateAndSend($ids);
            }

            if ($result) {
                $output->writeln('<info>Orders sent successfully.</info>');
            } else {
                $output->writeln('<error>Sending orders failed. Please check logs for more information.</error>');
            }
        } catch (\Exception $exception) {
            $output->writeln('<error>Operation failed. Please check input parameters.</error>');
        }
    }
}
