<?php

namespace App\Entity;

use App\Repository\UesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UesRepository::class)]
class Ues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $semestre = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ects = null;

    #[ORM\Column(length: 15)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $prerequis = null;

    #[ORM\Column]
    private ?int $cm = null;

    #[ORM\Column]
    private ?int $td = null;

    #[ORM\Column]
    private ?int $tp = null;

    #[ORM\Column]
    private ?int $effectif = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $groupeCM = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $groupeTD = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $groupeTP = null;

    #[ORM\ManyToOne(inversedBy: 'ues')]
    private ?Utilisateurs $utilisateurs = null;

    #[ORM\OneToMany(mappedBy: 'ues', targetEntity: Competences::class)]
    private Collection $competences;

    #[ORM\OneToMany(mappedBy: 'ues', targetEntity: Connaissances::class)]
    private Collection $connaissances;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'ues')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?MCCRNE $mcc = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'ues')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Statut $statut = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'ues')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Parcours $parcours = null;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->connaissances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(int $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEcts(): ?int
    {
        return $this->ects;
    }

    public function setEcts(int $ects): static
    {
        $this->ects = $ects;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getCm(): ?int
    {
        return $this->cm;
    }

    public function setCm(int $cm): static
    {
        $this->cm = $cm;

        return $this;
    }

    public function getTd(): ?int
    {
        return $this->td;
    }

    public function setTd(int $td): static
    {
        $this->td = $td;

        return $this;
    }

    public function getTp(): ?int
    {
        return $this->tp;
    }

    public function setTp(int $tp): static
    {
        $this->tp = $tp;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(int $effectif): static
    {
        $this->effectif = $effectif;

        return $this;
    }

    public function getGroupeCM(): ?int
    {
        return $this->groupeCM;
    }

    public function setGroupeCM(int $groupeCM): static
    {
        $this->groupeCM = $groupeCM;

        return $this;
    }

    public function getGroupeTD(): ?int
    {
        return $this->groupeTD;
    }

    public function setGroupeTD(int $groupeTD): static
    {
        $this->groupeTD = $groupeTD;

        return $this;
    }

    public function getGroupeTP(): ?int
    {
        return $this->groupeTP;
    }

    public function setGroupeTP(int $groupeTP): static
    {
        $this->groupeTP = $groupeTP;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): static
    {
        $this->utilisateurs = $utilisateurs;

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
            $competence->setUes($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): static
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getUes() === $this) {
                $competence->setUes(null);
            }
        }

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
            $connaissance->setUes($this);
        }

        return $this;
    }

    public function removeConnaissance(Connaissances $connaissance): static
    {
        if ($this->connaissances->removeElement($connaissance)) {
            // set the owning side to null (unless already changed)
            if ($connaissance->getUes() === $this) {
                $connaissance->setUes(null);
            }
        }

        return $this;
    }

    public function getMcc(): ?MCCRNE
    {
        return $this->mcc;
    }

    public function setMcc(?MCCRNE $mcc): static
    {
        $this->mcc = $mcc;

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

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): static
    {
        $this->parcours = $parcours;

        return $this;
    }

    
}
