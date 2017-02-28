<?php

namespace DDApi\Command;

use DDApi\Model\LeaveRequestRepository;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Command for make a list of the request
 */
class ListLeaveRequest extends Command
{
    public function getRequiredRole()
    {
        return null;
    }

    public function process()
    {
        $leaveRequestRepository = new LeaveRequestRepository();
        $leaveRequestList = $leaveRequestRepository->getByUserId($this->employee->getId());

        if (is_null($leaveRequestList)) {
            return [];
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