<?php

namespace MagentoBackendProjects\OrderStatusUpdater\Console\Command;

use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory as StatusCollectionFactory;

class UpdateOrderStatus extends Command
{
    const ARG_ORDER_ID = 'order_id';
    const ARG_STATUS   = 'status';

    protected $orderRepository;
    protected $statusCollectionFactory;
    protected $appState;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        StatusCollectionFactory $statusCollectionFactory,
        State $appState
    ) {
        $this->orderRepository = $orderRepository;
        $this->statusCollectionFactory = $statusCollectionFactory;
        $this->appState = $appState;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('order:update-status')
            ->setDescription('Update order status by order ID')
            ->addArgument(self::ARG_ORDER_ID, InputArgument::REQUIRED, 'Order ID')
            ->addArgument(self::ARG_STATUS, InputArgument::REQUIRED, 'New Status');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->appState->setAreaCode('adminhtml');
        } catch (\Exception $e) {
            // already set
        }

        $orderId = $input->getArgument(self::ARG_ORDER_ID);
        $newStatus = $input->getArgument(self::ARG_STATUS);

        try {
            $order = $this->orderRepository->get($orderId);
        } catch (\Exception $e) {
            $output->writeln("<error>Order with ID $orderId does not exist.</error>");
            return Cli::RETURN_FAILURE;
        }

        // Validate status
        $validStatuses = $this->statusCollectionFactory->create()->getColumnValues('status');
        if (!in_array($newStatus, $validStatuses)) {
            $output->writeln("<error>Invalid status: $newStatus</error>");
            $output->writeln("<info>Valid statuses: " . implode(', ', $validStatuses) . "</info>");
            return Cli::RETURN_FAILURE;
        }

        try {
            $order->setStatus($newStatus);
            $this->orderRepository->save($order);

            $output->writeln("<info>Order #$orderId status updated successfully to: $newStatus</info>");
            return Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("<error>Error updating order: {$e->getMessage()}</error>");
            return Cli::RETURN_FAILURE;
        }
    }
}
