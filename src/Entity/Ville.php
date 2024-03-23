<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'villes')]
    #[ORM\JoinColumn(name: "code_pays", referencedColumnName: "code_pays", nullable: false)]
    private ?Pays $code_pays = null;

    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'ville_depart')]
    private Collection $etapes_depart;

    public function __construct()
    {
        $this->etapes_depart = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodePays(): ?Pays
    {
        return $this->code_pays;
    }

    public function setCodePays(?Pays $code_pays): static
    {
        $this->code_pays = $code_pays;

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapesDepart(): Collection
    {
        return $this->etapes_depart;
    }

    public function addEtapesDepart(Etape $etapesDepart): static
    {
        if (!$this->etapes_depart->contains($etapesDepart)) {
            $this->etapes_depart->add($etapesDepart);
            $etapesDepart->setVilleDepart($this);
        }

        return $this;
    }

    public function removeEtapesDepart(Etape $etapesDepart): static
    {
        if ($this->etapes_depart->removeElement($etapesDepart)) {
            // set the owning side to null (unless already changed)
            if ($etapesDepart->getVilleDepart() === $this) {
                $etapesDepart->setVilleDepart(null);
            }
        }

        return $this;
    }
}
