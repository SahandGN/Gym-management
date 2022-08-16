<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Repository\MembershipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'membership', targetEntity: User::class)]
    private Collection $member;

    public function __construct()
    {
        $this->member = new ArrayCollection();
    }


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

    /**
     * @return Collection<int, User>
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(User $member): self
    {
        if (!$this->member->contains($member)) {
            $this->member->add($member);
            $member->setMembership($this);
        }

        return $this;
    }

    public function removeMember(User $member): self
    {
        if ($this->member->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getMembership() === $this) {
                $member->setMembership(null);
            }
        }

        return $this;
    }
}
