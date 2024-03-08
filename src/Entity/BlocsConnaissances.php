<?php

namespace App\Entity;

use App\Repository\BlocsConnaissancesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocsConnaissancesRepository::class)]
class BlocsConnaissances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    private ?string $idConn = null;

    #[ORM\Column(length: 10)]
    private ?string $nomBlocConn = null;

    #[ORM\Column(length: 255)]
    private ?string $DescriptionBlocConn = null;

    #[ORM\ManyToOne(inversedBy: 'blocConnaissances')]
    private ?Diplomes $diplomes = null;

    #[ORM\ManyToOne(inversedBy: 'blocConnaissances')]
    private ?Connaissances $connaissances = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdConn(): ?string
    {
        return $this->idConn;
    }

    public function setIdConn(string $idConn): static
    {
        $this->idConn = $idConn;

        return $this;
    }

    public function getNomBlocConn(): ?string
    {
        return $this->nomBlocConn;
    }

    public function setNomBlocConn(string $nomBlocConn): static
    {
        $this->nomBlocConn = $nomBlocConn;

        return $this;
    }

    public function getDescriptionBlocConn(): ?string
    {
        return $this->DescriptionBlocConn;
    }

    public function setDescriptionBlocConn(string $DescriptionBlocConn): static
    {
        $this->DescriptionBlocConn = $DescriptionBlocConn;

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

    public function getConnaissances(): ?Connaissances
    {
        return $this->connaissances;
    }

    public function setConnaissances(?Connaissances $connaissances): static
    {
        $this->connaissances = $connaissances;

        return $this;
    }
}
