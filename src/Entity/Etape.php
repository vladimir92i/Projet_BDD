<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Schema\View;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $num_etape = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?float $distance_parcouru = null;

    #[ORM\ManyToOne(inversedBy: 'etapes_depart')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville_depart = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville_arrive = null;

    #[ORM\ManyToOne(inversedBy: 'vainqueur')]
    #[ORM\JoinColumn(name: "vainqueur", referencedColumnName: "num_dossard")]
    private ?Coureur $vainqueur = null;

    #[ORM\OneToMany(targetEntity: Resultat::class, mappedBy: 'etape', orphanRemoval: true)]
    private Collection $resultat;

    public function __construct()
    {
        $this->resultat = new ArrayCollection();
    }

    public function getNum_etape(): ?int
    {
        return $this->num_etape;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

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

    public function getDistanceParcouru(): ?float
    {
        return $this->distance_parcouru;
    }

    public function setDistanceParcouru(float $distance_parcouru): static
    {
        $this->distance_parcouru = $distance_parcouru;

        return $this;
    }

    public function getVilleDepart(): ?Ville
    {
        return $this->ville_depart;
    }

    public function setVilleDepart(?Ville $ville_depart): static
    {
        $this->ville_depart = $ville_depart;

        return $this;
    }

    public function getVilleArrive(): ?Ville
    {
        return $this->ville_arrive;
    }

    public function setVilleArrive(?Ville $ville_arrive): static
    {
        $this->ville_arrive = $ville_arrive;

        return $this;
    }

    public function getVainqueur(): ?Coureur
    {
        return $this->vainqueur;
    }

    public function setVainqueur(?Coureur $vainqueur): static
    {
        $this->vainqueur = $vainqueur;

        return $this;
    }

    /**
     * @return Collection<int, Resultat>
     */
    public function getResultat(): Collection
    {
        return $this->resultat;
    }

    public function addResultat(Resultat $resultat): static
    {
        if (!$this->resultat->contains($resultat)) {
            $this->resultat->add($resultat);
            $resultat->setEtape($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): static
    {
        if ($this->resultat->removeElement($resultat)) {
            // set the owning side to null (unless already changed)
            if ($resultat->getEtape() === $this) {
                $resultat->setEtape(null);
            }
        }

        return $this;
    }
}
