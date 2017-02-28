<?php

namespace DDApi\Command;

use DDApi\Model\Employee;
use DDApi\Model\EmployeeRepository;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Interface for the commands
 */
abstract class Command
{
    /**
     * @var Employee
     */
    protected $employee;

    /**
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    protected $result=[];

    abstract function process();

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    abstract function getRequiredRole();

    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();

        if (!isset($_REQUEST['api_key'])) {
            $this->result = ['error' => 'wrong request: api key not found'];
            return;
        }

        $employeeList = $this->employeeRepository->getByApiKey($_REQUEST['api_key']);
        if (is_null($employeeList)) {
            $this->result = ['error' => 'api key not valid'];
            return;
        }

        $this->employee = $employeeList[0];

        if (!is_null($this->getRequiredRole()) && !in_array($this->getRequiredRole(), $this->employee->getRoles())) {
            $this->result = ['error' => 'the user ' . $this->employee->getId() . ' don\'t have permission for that request'];
            return;
        }

        $this->result = $this->process();
    }
}