<?php

namespace App\Entity;

use App\Repository\MCCRNERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MCCRNERepository::class)]
class MCCRNE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $session1 = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $secondeChance = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $session2 = null;

    #[ORM\OneToMany(mappedBy: 'mcc', targetEntity: Ues::class)]
    private Collection $ues;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession1(): ?string
    {
        return $this->session1;
    }

    public function setSession1(string $session1): static
    {
        $this->session1 = $session1;

        return $this;
    }

    public function getSecondeChance(): ?string
    {
        return $this->secondeChance;
    }

    public function setSecondeChance(string $secondeChance): static
    {
        $this->secondeChance = $secondeChance;

        return $this;
    }

    public function getSession2(): ?string
    {
        return $this->session2;
    }

    public function setSession2(string $session2): static
    {
        $this->session2 = $session2;

        return $this;
    }

    /**
     * @return Collection<int, Ues>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(Ues $ue): static
    {
        if (!$this->ues->contains($ue)) {
            $this->ues->add($ue);
            $ue->setMcc($this);
        }

        return $this;
    }

    public function removeUe(Ues $ue): static
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getMcc() === $this) {
                $ue->setMcc(null);
            }
        }

        return $this;
    }
}
