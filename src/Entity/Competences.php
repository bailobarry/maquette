<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ectsComp = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionComp = null;

    #[ORM\OneToMany(mappedBy: 'competences', targetEntity: BlocsCompetences::class)]
    private Collection $blocCompetences;

    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?Ues $ues = null;

    public function __construct()
    {
        $this->blocCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEctsComp(): ?int
    {
        return $this->ectsComp;
    }

    public function setEctsComp(int $ectsComp): static
    {
        $this->ectsComp = $ectsComp;

        return $this;
    }

    public function getDescriptionComp(): ?string
    {
        return $this->descriptionComp;
    }

    public function setDescriptionComp(string $descriptionComp): static
    {
        $this->descriptionComp = $descriptionComp;

        return $this;
    }

    /**
     * @return Collection<int, BlocsCompetences>
     */
    public function getBlocCompetences(): Collection
    {
        return $this->blocCompetences;
    }

    public function addBlocCompetence(BlocsCompetences $blocCompetence): static
    {
        if (!$this->blocCompetences->contains($blocCompetence)) {
            $this->blocCompetences->add($blocCompetence);
            $blocCompetence->setCompetences($this);
        }

        return $this;
    }

    public function removeBlocCompetence(BlocsCompetences $blocCompetence): static
    {
        if ($this->blocCompetences->removeElement($blocCompetence)) {
            // set the owning side to null (unless already changed)
            if ($blocCompetence->getCompetences() === $this) {
                $blocCompetence->setCompetences(null);
            }
        }

        return $this;
    }

    public function getUes(): ?Ues
    {
        return $this->ues;
    }

    public function setUes(?Ues $ues): static
    {
        $this->ues = $ues;

        return $this;
    }
}
