<?php

namespace App\Entity;

use App\Repository\BlocsCompetencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocsCompetencesRepository::class)]
class BlocsCompetences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    private ?string $idComp = null;

    #[ORM\Column(length: 100)]
    private ?string $nomBlocComp = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionBlocComp = null;

    #[ORM\ManyToOne(inversedBy: 'blocCompetences')]
    private ?Diplomes $diplomes = null;

    #[ORM\ManyToOne(inversedBy: 'blocCompetences')]
    private ?Competences $competences = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComp(): ?string
    {
        return $this->idComp;
    }

    public function setIdComp(string $idComp): static
    {
        $this->idComp = $idComp;

        return $this;
    }

    public function getNomBlocComp(): ?string
    {
        return $this->nomBlocComp;
    }

    public function setNomBlocComp(string $nomBlocComp): static
    {
        $this->nomBlocComp = $nomBlocComp;

        return $this;
    }

    public function getDescriptionBlocComp(): ?string
    {
        return $this->descriptionBlocComp;
    }

    public function setDescriptionBlocComp(string $descriptionBlocComp): static
    {
        $this->descriptionBlocComp = $descriptionBlocComp;

        return $this;
    }

    public function getDiplomes(): ?Diplomes
    {
        return $this->diplomes;
    }

    public function setDiplomes(?Diplomes $diplomes): static
    {
        $this->diplomes = $diplomes;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): static
    {
        $this->competences = $competences;

        return $this;
    }
}
