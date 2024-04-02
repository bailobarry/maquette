<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 30)]
    private ?string $prenomUser = null;

    #[ORM\Column(length: 30)]
    private ?string $mail = null;

    #[ORM\Column(length: 15)]
    private ?string $password = null;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Diplomes $diplomes = null;

    #[ORM\OneToMany(mappedBy: 'utilisateurs', targetEntity: Ues::class)]
    private Collection $ues;

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Role $role = null;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): static
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): static
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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
            $ue->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeUe(Ues $ue): static
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getUtilisateurs() === $this) {
                $ue->setUtilisateurs(null);
            }
        }

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }
}
