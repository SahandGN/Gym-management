<?php

namespace App\Model;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait TimeLoggerTrait
{

    #[ORM\Column(type:'datetime_immutable')]
    protected DateTimeImmutable $createdAt;

    #[ORM\Column(type:'datetime_immutable')]
    protected DateTimeImmutable $updatedAt;

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return TimeLoggerTrait
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable $updatedAt
     * @return TimeLoggerTrait
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}