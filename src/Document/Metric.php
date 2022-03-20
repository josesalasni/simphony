<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document() */ 
class Metric
{
    /** @MongoDB\Id(strategy="auto") */
    protected $id;

    /** @MongoDB\Field(type="date") */
    protected $reportDate;

    /** @MongoDB\Field(type="object_id") */
    protected string $accountId;
    
    /** @MongoDB\Field(type="float") */
    protected int $spent;

    /** @MongoDB\Field(type="int") */
    protected int $impressions;

    /** @MongoDB\Field(type="int") */
    protected int $clicks;
    
    public function getDate() { return $this->date; } 
    public function getAccountId() { return $this->accountId; }
    public function getId() { return $this->id; } 
    public function getImpressions() { return $this->impressions; }
    public function getClicks() { return $this->clicks; }
    public function getSpent() { return $this->spent;}

    public function setDate(string $date) { $this->reportDate = $date; }
    public function setAccountId(string $accountId) { $this->accountId = $accountId; }
    public function setSpent(string $spent) { $this->spent= $spent; }
    public function setimpressions(string $impressions) { $this->impressions= $impressions; }
    public function setClicks(string $clicks) { $this->clicks= $clicks; }
}