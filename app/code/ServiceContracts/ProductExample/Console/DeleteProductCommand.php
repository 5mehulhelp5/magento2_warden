<?php

namespace ServiceContracts\ProductExample\Console;

use Magento\Framework\App\State;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteProductCommand extends Command
{
    private $state;
    private $productRepository;

    public function __construct(
        State $state,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct();
        $this->state = $state;
        $this->productRepository = $productRepository;
    }

    protected function configure()
    {
        $this->setName('productexample:delete')
            ->setDescription('Delete product by SKU')
            ->addArgument('sku', InputArgument::REQUIRED, 'Product SKU');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            try {
                $this->state->setAreaCode('adminhtml');
            } catch (\Exception $e) {
            }

            $sku = $input->getArgument('sku');
            $this->productRepository->deleteById($sku);

            $output->writeln("<info>Product deleted (SKU: $sku)</info>");
            return Cli::RETURN_SUCCESS;
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $output->writeln("<error>Product not found: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        } catch (\Exception $e) {
            $output->writeln("<error>Error deleting product: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        }
    }
}
