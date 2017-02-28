<?php

namespace DDApi\Command;

use DDApi\Model\LeaveRequest;
use DDApi\Model\LeaveRequestRepository;
use DDApi\Validator\LeaveRequestValidator;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Command for make a list of the request
 */
class ListManagedLeaveRequest extends Command
{
    public function getRequiredRole()
    {
        return 'manager';
    }

    public function process()
    {
        $leaveRequestRepository = new LeaveRequestRepository();

        $leaveRequestList = [];
        foreach($this->employee->getEmployees() as $employeeId) {
            $leaveRequestListForEmployee = $leaveRequestRepository->getByUserId($employeeId);
            if (!is_null($leaveRequestListForEmployee)) {
                $leaveRequestList = array_merge($leaveRequestList,$leaveRequestListForEmployee);
            }
        }

        $leaveRequestListArray = [];
        foreach ($leaveRequestList as $leaveRequest) {
            $leaveRequestArray = $leaveRequest->toArray();
            $leaveRequestArray['comments'] = [];
            if (!is_null($leaveRequest->getComments())) {
                foreach($leaveRequest->getComments() as $comment) {
                    $leaveRequestArray['comments'][] = $comment->toArray();
                }
            }
            $leaveRequestListArray[] = $leaveRequestArray;
        }
        return $leaveRequestListArray;
    }
}