<?php

namespace DDApi\Model;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Base class for the model Entities
 */
abstract class Entity
{
    /**
     * @var string
     */
    protected $id = null;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    abstract function toArray();

}