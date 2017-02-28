<?php

namespace DDApi\Model;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Model Class for the Entity User
 */
class Employee extends Entity
{
    /**
     * @var string
     */
    private $apiKey = null;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * var array
     */
    private $Employees = [];

    /**
     * Employee constructor.
     * @param sting $id
     * @param string $apiKey
     * @param array $roles
     * @param array $Employees
     */
    public function __construct($id = null, $apiKey, $roles, $Employees=[])
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
        $this->roles = $roles;

        $this->Employees = $Employees;
    }

    static function fromArray($csvEntry)
    {
        $roles = explode('//', $csvEntry[2]);
        $employees = explode('//', $csvEntry[3]);
        if (count($employees) === 1 && $employees[0] === '') {
            $employees = [];
        }
        return new Employee($csvEntry[0], $csvEntry[1], $roles, $employees);
    }

    /**
     * @return array
     */
    public function getEmployees()
    {
        return $this->Employees;
    }

    /**
     * @param array $Employees
     */
    public function setEmployees($Employees)
    {
        $this->Employees = $Employees;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->id,
            $this->apiKey,
            implode('//', $this->roles),
            implode('//', $this->getEmployees())
        ];
    }
}