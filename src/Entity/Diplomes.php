<?php

namespace App\Entity;

use App\Repository\DiplomesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: DiplomesRepository::class)]
class Diplomes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $nomDip = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $etablissementDip = null;

    #[ORM\Column(length: 10)]
    #[Assert\Regex('/^[0-9_\/]+(?:-[0-9_\/]+)*$/')]
    private ?string $anneesDip = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Positive]
    private ?int $nbSemestresDip = null;

    #[ORM\Column(length: 10)]
    private ?string $lmd = null;

    #[ORM\OneToMany(mappedBy: 'diplomes', targetEntity: Parcours::class)]
    private Collection $parcours;

    #[ORM\OneToMany(mappedBy: 'diplomes', targetEntity: BlocsCompetences::class)]
    private Collection $blocCompetences;

    #[ORM\OneToMany(mappedBy: 'diplomes', targetEntity: BlocsConnaissances::class)]
    private Collection $blocConnaissances;

    #[ORM\OneToMany(mappedBy: 'diplomes', targetEntity: Utilisateurs::class)]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->parcours = new ArrayCollection();
        $this->blocCompetences = new ArrayCollection();
        $this->blocConnaissances = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDip(): ?string
    {
        return $this->nomDip;
    }

    public function setNomDip(string $nomDip): static
    {
        $this->nomDip = $nomDip;

        return $this;
    }

    public function getEtablissementDip(): ?string
    {
        return $this->etablissementDip;
    }

    public function setEtablissementDip(string $etablissementDip): static
    {
        $this->etablissementDip = $etablissementDip;

        return $this;
    }

    public function getAnneesDip(): ?string
    {
        return $this->anneesDip;
    }

    public function setAnneesDip(string $anneesDip): static
    {
        $this->anneesDip = $anneesDip;

        return $this;
    }

    public function getNbSemestresDip(): ?int
    {
        return $this->nbSemestresDip;
    }

    public function setNbSemestresDip(int $nbSemestresDip): static
    {
        $this->nbSemestresDip = $nbSemestresDip;

        return $this;
    }

    public function getLmd(): ?string
    {
        return $this->lmd;
    }

    public function setLmd(string $lmd): static
    {
        $this->lmd = $lmd;

        return $this;
    }

    /**
     * @return Collection<int, Parcours>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcours $parcour): static
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours->add($parcour);
            $parcour->setDiplomes($this);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): static
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getDiplomes() === $this) {
                $parcour->setDiplomes(null);
            }
        }

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
            $blocCompetence->setDiplomes($this);
        }

        return $this;
    }

    public function removeBlocCompetence(BlocsCompetences $blocCompetence): static
    {
        if ($this->blocCompetences->removeElement($blocCompetence)) {
            // set the owning side to null (unless already changed)
            if ($blocCompetence->getDiplomes() === $this) {
                $blocCompetence->setDiplomes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BlocsConnaissances>
     */
    public function getBlocConnaissances(): Collection
    {
        return $this->blocConnaissances;
    }

    public function addBlocConnaissance(BlocsConnaissances $blocConnaissance): static
    {
        if (!$this->blocConnaissances->contains($blocConnaissance)) {
            $this->blocConnaissances->add($blocConnaissance);
            $blocConnaissance->setDiplomes($this);
        }

        return $this;
    }

    public function removeBlocConnaissance(BlocsConnaissances $blocConnaissance): static
    {
        if ($this->blocConnaissances->removeElement($blocConnaissance)) {
            // set the owning side to null (unless already changed)
            if ($blocConnaissance->getDiplomes() === $this) {
                $blocConnaissance->setDiplomes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateurs $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setDiplomes($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getDiplomes() === $this) {
                $utilisateur->setDiplomes(null);
            }
        }

        return $this;
    }
}
