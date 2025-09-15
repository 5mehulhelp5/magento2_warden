<?php

namespace ServiceContracts\ProductExample\Console;

use Magento\Framework\App\State;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductCommand extends Command
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
        $this->setName('productexample:get')
            ->setDescription('Get product by SKU (service contract)')
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
            $product = $this->productRepository->get($sku);

            $output->writeln("ID: " . $product->getId());
            $output->writeln("SKU: " . $product->getSku());
            $output->writeln("Name: " . $product->getName());
            $output->writeln("Price: " . $product->getPrice());
            $output->writeln("Type: " . $product->getTypeId());
            $output->writeln("Status: " . $product->getStatus());

            return Cli::RETURN_SUCCESS;
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $output->writeln("<error>Product not found: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        } catch (\Exception $e) {
            $output->writeln("<error>Error: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        }
    }
}
