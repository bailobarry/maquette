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

    
    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?Ues $ues = null;

    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?BlocsCompetences $blocCompetences = null;

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

    public function getUes(): ?Ues
    {
        return $this->ues;
    }

    public function setUes(?Ues $ues): static
    {
        $this->ues = $ues;

        return $this;
    }

    public function getBlocCompetences(): ?BlocsCompetences
    {
        return $this->blocCompetences;
    }

    public function setBlocCompetences(?BlocsCompetences $blocCompetences): static
    {
        $this->blocCompetences = $blocCompetences;

        return $this;
    }
}
