<?php

namespace ServiceContracts\EmployeesExample\Api\Data;

interface EmployeeInterface
{
    const EMPLOYEE_ID = 'employee_id';
    const NAME        = 'name';
    const EMAIL       = 'email';
    const POSITION    = 'position';

    public function getId();
    public function setId($id);

    public function getName();
    public function setName($name);

    public function getEmail();
    public function setEmail($email);

    public function getPosition();
    public function setPosition($position);
}
