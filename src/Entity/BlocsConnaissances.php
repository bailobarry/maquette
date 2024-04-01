<?php

namespace App\Entity;

use App\Repository\BlocsConnaissancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 100)]
    private ?string $nomBlocConn = null;

    #[ORM\Column(length: 255)]
    private ?string $DescriptionBlocConn = null;

    #[ORM\ManyToOne(inversedBy: 'blocConnaissances')]
    private ?Diplomes $diplomes = null;

    #[ORM\OneToMany(targetEntity: Connaissances::class, mappedBy: 'blocConnaissances')]
    private Collection $connaissances;

    public function __construct()
    {
        $this->connaissances = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Connaissances>
     */
    public function getConnaissances(): Collection
    {
        return $this->connaissances;
    }

    public function addConnaissance(Connaissances $connaissance): static
    {
        if (!$this->connaissances->contains($connaissance)) {
            $this->connaissances->add($connaissance);
            $connaissance->setBlocConnaissances($this);
        }

        return $this;
    }

    public function removeConnaissance(Connaissances $connaissance): static
    {
        if ($this->connaissances->removeElement($connaissance)) {
            // set the owning side to null (unless already changed)
            if ($connaissance->getBlocConnaissances() === $this) {
                $connaissance->setBlocConnaissances(null);
            }
        }

        return $this;
    }


}
