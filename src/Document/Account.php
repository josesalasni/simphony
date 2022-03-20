<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document() */ 
class Account
{
    /** @MongoDB\Id(strategy="auto") */
    protected $_id;

    /** @MongoDB\Field(type="string") */
    protected $name;

    /** @MongoDB\Field(type="boolean") */
    protected $status;
    
    public function getName() { return $this->name; } 
    public function getStatus() { return $this->status; }
    public function getId() { return $this->_id; } 

    public function setName(string $name) { $this->name = $name; }
    public function setStatus(string $status) { $this->status = $status; }
}