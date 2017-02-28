<?php
namespace DDApi\Model;

use DDApi\Validator\LeaveRequestValidator;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Model Class for the Entity LeaveRequest
 */
class LeaveRequest extends Entity
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $dateStart;

    /**
     * @var string
     */
    private $dateEnd;

    /**
     * @var array
     */
    private $comments = [];

    /**
     * @var string
     */
    private $status;

    /**
     * LeaveRequest constructor.
     * @param string $id
     * @param string $userId
     * @param string $dateStart
     * @param string $dateEnd
     * @param array $comments
     * @param string $status
     */
    public function __construct($id = null, $userId, $dateStart, $dateEnd, $status, $comments=[])
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->comments = $comments;
        $this->status = $status;
    }


    static function fromArray($csvEntry)
    {
        return new LeaveRequest($csvEntry[0], $csvEntry[1], $csvEntry[2], $csvEntry[3], $csvEntry[4]);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param string $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param string $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }


    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param Comment
     */
    public function addComment($comment) {
        $this->comments[] = $comment;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->getId(),
            $this->getUserId(),
            $this->getDateStart(),
            $this->getDateEnd(),
            $this->getStatus()
        ];
    }

}