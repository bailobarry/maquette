<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    private ?string $idParc = null;

    #[ORM\Column(length: 100)]
    private ?string $nomParc = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $anneesParc = null;

    #[ORM\ManyToOne(inversedBy: 'parcours')]
    private ?Diplomes $diplomes = null;

    #[ORM\ManyToOne(inversedBy: 'parcours')]
    private ?Statut $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParc(): ?string
    {
        return $this->idParc;
    }

    public function setIdParc(string $idParc): static
    {
        $this->idParc = $idParc;

        return $this;
    }

    public function getNomParc(): ?string
    {
        return $this->nomParc;
    }

    public function setNomParc(string $nomParc): static
    {
        $this->nomParc = $nomParc;

        return $this;
    }

    public function getAnneesParc(): ?int
    {
        return $this->anneesParc;
    }

    public function setAnneesParc(int $anneesParc): static
    {
        $this->anneesParc = $anneesParc;

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

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
