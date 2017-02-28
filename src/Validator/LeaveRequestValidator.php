<?php

namespace DDApi\Validator;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Validator for the LeaveRequest
 */
class LeaveRequestValidator
{
    /**
     * @param  $request
     * @return bool
     */
    public static function validate($request)
    {
        // validate date_start
        if (!isset($request['date_start'])) {
            return 'wrong request: date_start must be present on the request';
        }

        if (\DateTime::createFromFormat('Y-m-d', $request['date_start']) === false || strlen($request['date_start']) !== 10 ) {
            return 'wrong request: date_start not valid, the correct format ist YYYY-mm-dd';
        }

        // validate date_end
        if (!isset($request['date_end'])) {
            return 'wrong request: date_end must be present on the request';
        }

        if (\DateTime::createFromFormat('Y-m-d', $request['date_start']) === false || strlen($request['date_start']) !== 10 ) {
            return 'wrong request: date_end not valid, the correct format ist YYYY-mm-dd';
        }

        return true;
    }
}