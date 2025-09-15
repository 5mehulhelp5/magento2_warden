<?php

namespace ServiceContracts\EmployeesExample\Console;

use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use ServiceContracts\EmployeesExample\Api\Data\EmployeeInterfaceFactory;
use ServiceContracts\EmployeesExample\Api\EmployeeRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateEmployeeCommand extends Command
{
    const NAME     = 'name';
    const EMAIL    = 'email';
    const POSITION = 'position';

    protected $employeeFactory;
    protected $employeeRepository;
    protected $state;

    public function __construct(
        EmployeeInterfaceFactory $employeeFactory,
        EmployeeRepositoryInterface $employeeRepository,
        State $state
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepository = $employeeRepository;
        $this->state = $state;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('employee:create')
            ->setDescription('Create a new employee')
            ->addArgument(self::NAME, InputArgument::REQUIRED, 'Employee Name')
            ->addArgument(self::EMAIL, InputArgument::REQUIRED, 'Employee Email')
            ->addArgument(self::POSITION, InputArgument::OPTIONAL, 'Employee Position', 'Developer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('frontend');

        $employee = $this->employeeFactory->create();
        $employee->setName($input->getArgument(self::NAME));
        $employee->setEmail($input->getArgument(self::EMAIL));
        $employee->setPosition($input->getArgument(self::POSITION));

        $this->employeeRepository->save($employee);

        $output->writeln("Employee '{$employee->getName()}' created with ID {$employee->getId()}");

        return Cli::RETURN_SUCCESS;
    }
}
