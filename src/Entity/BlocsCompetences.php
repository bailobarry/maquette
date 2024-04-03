<?php

namespace App\Entity;

use App\Repository\BlocsCompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BlocsCompetencesRepository::class)]
class BlocsCompetences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    #[Assert\Length(min: 2)]
    private ?string $idComp = null;

    #[ORM\Column(length: 100)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $nomBlocComp = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex('/^[a-zA-Z0-9éà_ ]+(?: -[a-z0-9éà_ ]+)*$/')]
    private ?string $descriptionBlocComp = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'blocCompetences')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Diplomes $diplomes = null;

    #[ORM\OneToMany(targetEntity: Competences::class, mappedBy: 'blocCompetences')]
    private Collection $competences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Competences>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
            $competence->setBlocCompetences($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): static
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getBlocCompetences() === $this) {
                $competence->setBlocCompetences(null);
            }
        }

        return $this;
    }

}
