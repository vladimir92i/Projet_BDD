<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $code_equipe = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    #[ORM\JoinColumn(name: "code_pays", referencedColumnName: "code_pays", nullable: false)]
    private ?Pays $code_pays = null;

    #[ORM\OneToMany(targetEntity: Coureur::class, mappedBy: 'code_equipe')]
    private Collection $coureurs;

    public function __toString(): string
    {
        return $this->code_equipe;
    }

    public function __construct()
    {
        $this->coureurs = new ArrayCollection();
    }

    public function getCodeEquipe(): ?string
    {
        return $this->code_equipe;
    }

    public function setCodeEquipe(string $code_equipe): static
    {
        $this->code_equipe = $code_equipe;

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

    public function getCodePays(): ?pays
    {
        return $this->code_pays;
    }

    public function setCodePays(?pays $code_pays): static
    {
        $this->code_pays = $code_pays;

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
            $coureur->setCodeEquipe($this);
        }

        return $this;
    }

    public function removeCoureur(Coureur $coureur): static
    {
        if ($this->coureurs->removeElement($coureur)) {
            // set the owning side to null (unless already changed)
            if ($coureur->getCodeEquipe() === $this) {
                $coureur->setCodeEquipe(null);
            }
        }

        return $this;
    }
}
