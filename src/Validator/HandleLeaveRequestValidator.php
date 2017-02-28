<?php

namespace DDApi\Validator;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Validator for the managements of the leave requests
 */
class HandleLeaveRequestValidator
{
    /**
     * @param  $request
     * @return bool
     */
    public static function validate($request)
    {
        if (!isset($request['status'])) {
            return 'wrong request: status must be present on the request';
        }

        if (!in_array($request['status'], ['pending', 'accepted', 'refused'])) {
            return 'wrong request: status must be pending accepted or refused';
        }

        return true;
    }
}