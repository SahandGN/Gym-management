<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Repository\MembershipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
#[ORM\MappedSuperclass]
class Membership extends Product implements TimeLoggerInterface
{

    use TimeLoggerTrait;

    #[ORM\Column]
    private ?int $length = null;

    #[ORM\Column]
    private ?int $duration = null;


    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
