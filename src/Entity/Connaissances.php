<?php

namespace App\Entity;

use App\Repository\ConnaissancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConnaissancesRepository::class)]
class Connaissances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ectsConn = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionConn = null;

    #[ORM\ManyToOne(inversedBy: 'connaissances')]
    private ?Ues $ues = null;

    #[ORM\ManyToOne(inversedBy: 'connaissances')]
    private ?BlocsConnaissances $blocConnaissances = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEctsConn(): ?int
    {
        return $this->ectsConn;
    }

    public function setEctsConn(int $ectsConn): static
    {
        $this->ectsConn = $ectsConn;

        return $this;
    }

    public function getDescriptionConn(): ?string
    {
        return $this->descriptionConn;
    }

    public function setDescriptionConn(string $descriptionConn): static
    {
        $this->descriptionConn = $descriptionConn;

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

    public function getBlocConnaissances(): ?BlocsConnaissances
    {
        return $this->blocConnaissances;
    }

    public function setBlocConnaissances(?BlocsConnaissances $blocConnaissances): static
    {
        $this->blocConnaissances = $blocConnaissances;

        return $this;
    }

}
