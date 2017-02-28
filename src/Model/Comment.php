<?php

namespace DDApi\Model;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Model Class for the Entity Comment
 */
class Comment extends Entity
{

    /**
     * @var string
     */
    private $employeeId;

    /**
     * @var string
     */
    private $creationDate;


    /**
     * @var string
     */
    private $leaveRequestId;

    /**
     * @var string
     */
    private $text;


    /**
     * Comment constructor.
     * @param string $id
     * @param string $employeeId
     * @param string $creationDate
     * @param string $leaveRequestId
     * @param string $text
     */
    public function __construct($id = null, $employeeId, $creationDate, $leaveRequestId, $text)
    {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->creationDate = $creationDate;
        $this->leaveRequestId = $leaveRequestId;
        $this->text = $text;
    }

    static function fromArray($csvEntry)
    {
        return new Comment($csvEntry[0], $csvEntry[1], $csvEntry[2], $csvEntry[3], $csvEntry[4]);
    }

    /**
     * @return string
     */
    public function getLeaveRequestId()
    {
        return $this->leaveRequestId;
    }

    /**
     * @param string $leaveRequestId
     */
    public function setLeaveRequestId($leaveRequestId)
    {
        $this->leaveRequestId = $leaveRequestId;
    }

    /**
     * @return string
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @param string $employeeId
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * @return int
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param int $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function toArray()
    {
        return [
            $this->id,
            $this->employeeId,
            $this->creationDate,
            $this->leaveRequestId,
            $this->text
        ];
    }
}