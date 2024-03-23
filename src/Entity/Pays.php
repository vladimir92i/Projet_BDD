<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\Column(length: 3)]
    private ?string $code_pays = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Ville::class, mappedBy: 'code_pays', orphanRemoval: true)]
    private Collection $villes;

    #[ORM\OneToMany(targetEntity: Equipe::class, mappedBy: 'code_pays')]
    private Collection $equipes;

    #[ORM\OneToMany(targetEntity: Coureur::class, mappedBy: 'code_pays')]
    private Collection $coureurs;

    public function __toString(): string
    {
        return $this->code_pays;
    }

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->coureurs = new ArrayCollection();
    }

    public function getCodePays(): ?string
    {
        return $this->code_pays;
    }

    public function setCodePays(string $code_pays): static
    {
        $this->code_pays = $code_pays;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->setCodePays($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getCodePays() === $this) {
                $ville->setCodePays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setCodePays($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getCodePays() === $this) {
                $equipe->setCodePays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coureur>
     */
    public function getCoureurs(): Collection
    {
        return $this->coureurs;
    }

    public function addCoureur(Coureur $coureur): static
    {
        if (!$this->coureurs->contains($coureur)) {
            $this->coureurs->add($coureur);
            $coureur->setCodePays($this);
        }

        return $this;
    }

    public function removeCoureur(Coureur $coureur): static
    {
        if ($this->coureurs->removeElement($coureur)) {
            // set the owning side to null (unless already changed)
            if ($coureur->getCodePays() === $this) {
                $coureur->setCodePays(null);
            }
        }

        return $this;
    }
}
