<?php

namespace ServiceContracts\ProductExample\Console;

use Magento\Framework\App\State;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateProductCommand extends Command
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
        $this->setName('productexample:update')
            ->setDescription('Update product price (sku, price)')
            ->addArgument('sku', InputArgument::REQUIRED, 'Product SKU')
            ->addArgument('price', InputArgument::REQUIRED, 'New price (float)');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            try {
                $this->state->setAreaCode('adminhtml');
            } catch (\Exception $e) {
            }

            $sku   = $input->getArgument('sku');
            $price = (float)$input->getArgument('price');

            $product = $this->productRepository->get($sku);
            $product->setPrice($price);
            $this->productRepository->save($product);

            $output->writeln("<info>Product updated (SKU: $sku) new price: $price</info>");
            return Cli::RETURN_SUCCESS;
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $output->writeln("<error>Product not found: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        } catch (\Exception $e) {
            $output->writeln("<error>Error updating product: " . $e->getMessage() . "</error>");
            return Cli::RETURN_FAILURE;
        }
    }
}
