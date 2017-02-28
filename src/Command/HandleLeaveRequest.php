<?php

namespace DDApi\Command;

use DDApi\Model\Comment;
use DDApi\Validator\HandleLeaveRequestValidator;
use DDApi\Model\LeaveRequestRepository;


/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Command for change the status of the leave request
 */
class HandleLeaveRequest extends Command
{

    public function getRequiredRole()
    {
        return 'manager';
    }

    public function process()
    {
        $leaveRequestRepository = new LeaveRequestRepository();
        if (!isset($_REQUEST['leave_request_id'])) {
            return  ['error'=>'Parameter leave_request_id not found in the request'];
        }
        $leaveRequest = $leaveRequestRepository->getById($_REQUEST['leave_request_id']);

        if (is_null($leaveRequest)) {
            return ['error'=>'Leave request not found'];
        }

        if (!in_array($leaveRequest->getUserId(),$this->employee->getEmployees())) {
            return ['error'=>'The user don\'t have permissions for that employee'];
        }

        $validatorResult = HandleLeaveRequestValidator::validate($_REQUEST);
        if ($validatorResult !== true) {
            return [
                'error' => $validatorResult
            ];
        };

        $leaveRequest->setStatus($_REQUEST['status']);

        if (isset($_REQUEST['comment'])) {
            $date = new \DateTime();
            $creationDate = $date->format('Y-m-d');
            $comment = new Comment(null, $this->employee->getId(), $creationDate, null, $_REQUEST['comment']);
            $leaveRequest->addComment($comment);
        }

        $leaveRequestRepository->persist($leaveRequest);
        $leaveRequestRepository->flush();

        $leaveRequestArray = $leaveRequest->toArray();
        $leaveRequestArray['comments'] = [];
        if (!is_null($leaveRequest->getComments())) {
            foreach($leaveRequest->getComments() as $comment) {
                $leaveRequestArray['comments'][] = $comment->toArray();
            }
        }
        $leaveRequestListArray[] = $leaveRequestArray;

        return $leaveRequestArray;
    }

}