<?php

namespace App\Entity;

use App\Repository\MCCRNERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MCCRNERepository::class)]
class MCCRNE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $intituleMcc = null;

    #[ORM\Column(length: 100)]
    private ?string $descriptionMcc = null;


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

    public function getIntituleMcc(): ?string
    {
        return $this->intituleMcc;
    }

    public function setIntituleMcc(string $intituleMcc): static
    {
        $this->intituleMcc = $intituleMcc;

        return $this;
    }

    public function getdescriptionMcc(): ?string
    {
        return $this->descriptionMcc;
    }

    public function setdescriptionMcc(string $descriptionMcc): static
    {
        $this->descriptionMcc = $descriptionMcc;

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
