<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $idParc = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $nomParc = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Regex('/^[0-9_\/]+(?:-[0-9_\/]+)*$/')]
    private ?string $anneesParc = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'parcours')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Diplomes $diplomes = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'parcours')]
    private ?Statut $statut = null;

    #[ORM\OneToMany(targetEntity: Ues::class, mappedBy: 'parcours')]
    private Collection $ues;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
    }

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

    public function getAnneesParc(): ?string
    {
        return $this->anneesParc;
    }

    public function setAnneesParc(string $anneesParc): static
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
            $ue->setParcours($this);
        }

        return $this;
    }

    public function removeUe(Ues $ue): static
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getParcours() === $this) {
                $ue->setParcours(null);
            }
        }

        return $this;
    }

}
