<?php

namespace ServiceContracts\ProductExample\Console;

use Magento\Framework\App\State;
use Magento\Catalog\Api\Data\ProductInterfaceFactory; //for product details
use Magento\Catalog\Api\ProductRepositoryInterface; //for crud
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProductCommand extends Command
{
    private $state;
    private $productFactory;
    private $productRepository;

    public function __construct(
        State $state,
        ProductInterfaceFactory $productFactory,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct();
        $this->state = $state;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    protected function configure()
    {
        $this->setName('productexample:create')
            ->setDescription('Create a simple product (sku, name, price)')
            ->addArgument('sku', InputArgument::REQUIRED, 'Product SKU')
            ->addArgument('name', InputArgument::REQUIRED, 'Product name')
            ->addArgument('price', InputArgument::REQUIRED, 'Product price (float)');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('frontend');

        $sku   = $input->getArgument('sku');
        $name  = $input->getArgument('name');
        $price = $input->getArgument('price');

        $product = $this->productFactory->create();
        $product->setSku($sku);
        $product->setName($name);
        $product->setPrice($price);
        $product->setTypeId('simple');
        $product->setAttributeSetId(4); // Default attribute set
        $product->setWebsiteIds([1]);   // Assign to default website
        $product->setVisibility(4);     // Visible in catalog & search
        $product->setStatus(1);         // Enabled
        $product->setStockData([
            'use_config_manage_stock' => 1,
            'qty' => 100,
            'is_qty_decimal' => 0,
            'is_in_stock' => 1,
        ]);

        $this->productRepository->save($product);

        $output->writeln("Product '{$name}' created with SKU '{$sku}'");

        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}
