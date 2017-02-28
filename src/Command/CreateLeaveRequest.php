<?php

namespace DDApi\Command;

use DDApi\Model\LeaveRequest;
use DDApi\Model\Comment;
use DDApi\Validator\LeaveRequestValidator;
use DDApi\Model\LeaveRequestRepository;


/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Command for make a new LeaveRequest
 */
class CreateLeaveRequest extends Command
{
    public function getRequiredRole()
    {
        return null;
    }


    public function process()
    {
        $validatorResult = LeaveRequestValidator::validate($_REQUEST);
        if ($validatorResult !== true) {
            return [
                'error' => $validatorResult
            ];
        };
        $leaveRequest = new LeaveRequest(null, $this->employee->getId(), $_REQUEST['date_start'], $_REQUEST['date_end'], 'pending');
        if (isset($_REQUEST['comment'])) {
            $date = new \DateTime();
            $creationDate = $date->format('Y-m-d');
            $comment = new Comment(null, null, $creationDate, null, $_REQUEST['comment']);
            $leaveRequest->addComment($comment);
        }

        $leaveRequestRepository = new LeaveRequestRepository();
        $leaveRequestRepository->persist($leaveRequest);
        $leaveRequestRepository->flush();

        return $leaveRequest->toArray();
    }
}