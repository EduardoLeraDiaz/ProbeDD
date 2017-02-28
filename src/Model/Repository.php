<?php

namespace DDApi\Model;

/**
 * author Eduardo Lera Diaz <elera@uoc.edu>
 * Base class for the Repositories
 */
abstract class Repository
{
    /**
     * @return string
     */
    protected function getFileName()
    {
        return array_pop(explode('\\', get_class($this))) . '.csv';
    }

    protected function getEntityName()
    {
        return str_replace('Repository', '', get_class($this));
    }
    
    protected static $files=[];
    protected static $data=[];
    

    public function __construct()
    {
        if (!isset(Repository::$files[$this->getFileName()])) {
            Repository::$data[$this->getFileName()] = [];
            Repository::$files[$this->getFileName()] = fopen(__DIR__ . '/../../Data/' . $this->getFileName(), 'c+');
            while (($entry = fgetcsv(Repository::$files[$this->getFileName()])) !== false) {
                Repository::$data[$this->getFileName()][$entry[0]] = $entry;
            }
        }
    }

    public function __call($method, $args)
    {
        if (preg_match('/getBy(.*)/', $method, $matches) === 1) {
            return $this->getList(lcfirst($matches[1]), $args[0]);
        }
        trigger_error('Call to undefined method ' . __CLASS__ . '::' . $method . '()', E_USER_ERROR);
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function getById($id)
    {
        if (!isset(Repository::$data[$this->getFileName()][$id])) {
            return null;
        }
        $entityName = $this->getEntityName();
        return $entityName::fromArray(Repository::$data[$this->getFileName()][$id]);
    }

    /**
     * @param Entity $entity
     */
    public function persist($entity)
    {
        // Give a id for new entities
        if (is_null($entity->getId())) {
            $keys = array_keys(Repository::$data[$this->getFileName()]);
            ksort($keys);
            $lastIndex = array_pop($keys);
            is_null($lastIndex) ? $entity->setId('1') : $entity->setId(((int)$lastIndex) + 1);
        }

        Repository::$data[$this->getFileName()][$entity->getId()] = $entity->toArray();
    }

    public function flush()
    {
        ftruncate(Repository::$files[$this->getFileName()], 0);
        foreach (Repository::$data[$this->getFileName()] as $id => $entry) {
            fputcsv(Repository::$files[$this->getFileName()], $entry);
        }
        fclose(Repository::$files[$this->getFileName()]);
    }


    private function getList($propertyName, $value)
    {
        $list = [];
        if (property_exists($this->getEntityName(), $propertyName) === true) {
            foreach (Repository::$data[$this->getFileName()] as $key => $entry) {
                $entityName = $this->getEntityName();
                $entity = $entityName::fromArray($entry);
                $getMethod = 'get' . ucfirst($propertyName);
                $entityValue = $entity->$getMethod();
                if ($entityValue === $value) {
                    $list[] = $entity;
                }
            }
            if (count($list) === 0) {
                return null;
            }
            return $list;
        }
        trigger_error('Property ' . $propertyName . ' not found', E_USER_ERROR);
    }


}