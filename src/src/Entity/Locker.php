<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Repository\LockerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LockerRepository::class)]
class Locker implements TimeLoggerInterface
{

    use TimeLoggerTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isEmpty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function isIsEmpty(): ?bool
    {
        return $this->isEmpty;
    }

    public function setIsEmpty(?bool $isEmpty): self
    {
        $this->isEmpty = $isEmpty;

        return $this;
    }
}
