<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DDApi\Model\EmployeeRepository;
use DDApi\Model\Employee;

$repo = new EmployeeRepository();
$employee1 = new Employee(null,'apiKey1',['employee']);
$employee2 = new Employee(null,'apiKey2',['employee']);
$employee3 = new Employee(null,'apiKey3',['employee']);
$employee4 = new Employee(null,'apiKey4',['employee']);
$employee5 = new Employee(null,'apiKey5',['employee']);
$repo->persist($employee1);
$repo->persist($employee2);
$repo->persist($employee3);
$repo->persist($employee4);
$repo->persist($employee5);
$employee6 = new Employee(null,'apiKey6',['employee','manager'],[$employee1->getId(),$employee2->getId(),$employee3->getId()]);
$employee7 = new Employee(null,'apiKey7',['employee','manager'],[$employee4->getId(),$employee5->getId()]);


$repo->persist($employee6);
$repo->persist($employee7);
$repo->flush();





