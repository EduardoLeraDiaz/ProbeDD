<?php

namespace DDApi\Model;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Model Class for the Entity LeaveRequest
 */
class LeaveRequestRepository extends Repository
{

    /**
     * @param int $id
     * @return LeaveRequest
     */
    private $commentRepository;

    public function  __construct() {
        parent::__construct();
        $this->commentRepository = new CommentRepository();
    }

    /**
     * @param int $id
     * @return LeaveRequest
     */
    public function getById($id)
    {
        /**
         * var LeaveRequest
         */
        $leaveRequest = parent::getById($id);
        if(is_null($leaveRequest)) {
            return null;
        }
        $this->attachComments([$leaveRequest]);

        return $leaveRequest;
    }

    public function __call($method, $args)
    {
        $leaveRequests = parent::__call($method, $args);
        if (!is_null($leaveRequests)) {
            $this->attachComments($leaveRequests);
        }
        return $leaveRequests;
    }

    /**
     * @param $leaveRequest $leaveRequest
     */
    public function persist($leaveRequest)
    {
        parent::persist($leaveRequest);
        foreach($leaveRequest->getComments() as $comment) {
            $comment->setEmployeeId($leaveRequest->getUserId());
            $comment->setLeaveRequestId($leaveRequest->getId());
            $this->commentRepository->persist($comment);
        }
    }

    public function flush() {
        parent::flush();
        $this->commentRepository->flush();
    }


    private function attachComments($leaveRequests)
    {
        foreach ($leaveRequests as $leaveRequest) {
            $leaveRequest->setComments($this->commentRepository->getByLeaveRequestId($leaveRequest->getId()));
        }
    }

}