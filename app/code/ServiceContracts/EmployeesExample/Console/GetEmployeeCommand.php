<?php

namespace ServiceContracts\EmployeesExample\Console;

use Magento\Framework\App\State;
use Magento\Framework\Exception\NoSuchEntityException;
use ServiceContracts\EmployeesExample\Api\EmployeeRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetEmployeeCommand extends Command
{
    const ID_ARGUMENT = 'id';

    protected $employeeRepository;
    protected $state;

    public function __construct(
        State $state,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->state = $state;
        $this->employeeRepository = $employeeRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('employeeexample:get')
            ->setDescription('Get employee by ID')
            ->addArgument(
                self::ID_ARGUMENT,
                InputArgument::REQUIRED,
                'Employee ID'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('frontend');

        $id = $input->getArgument(self::ID_ARGUMENT);

        try {
            $employee = $this->employeeRepository->getById($id);
            $output->writeln("Employee Found:");
            $output->writeln("ID: " . $employee->getId());
            $output->writeln("Name: " . $employee->getName());
            $output->writeln("Email: " . $employee->getEmail());
        } catch (NoSuchEntityException $e) {
            $output->writeln("❌ " . $e->getMessage());
        }

        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}
