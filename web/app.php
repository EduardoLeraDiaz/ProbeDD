<?php

require_once __DIR__ . '/../vendor/autoload.php';

// check if that's a cli call and the format of the arguments
if (php_sapi_name() === 'cli') {
    $_REQUEST = [];
    try {
        array_shift($argv);
        foreach ($argv as $argument) {
            $argumentAsArray = explode('=', $argument);
            if (count($argumentAsArray) !== 2) {
                throw new \Exception('Invalid argument exception');
            }
            $_REQUEST[$argumentAsArray[0]] = $argumentAsArray[1];
        }
    } catch (\Exception $e) {
        echo json_encode([
            'error' => 'Wrong Request'
        ]);
        die();
    }
}

// check if the command exists in our api
if (!isset($_REQUEST['command'])) {
    echo json_encode([
        'error' => 'Command not provided'
    ]);
    die();
}
$commandClassName = 'DDApi\\Command\\' . str_replace('_', '', ucwords($_REQUEST['command'], '_'));
if (!class_exists($commandClassName)) {
    echo json_encode([
        'error' => 'Command not found'
    ]);
    die();
}


/**
 * var Command $command
 */
$command = new $commandClassName();

echo json_encode($command->getResult());






