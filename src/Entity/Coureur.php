<?php

namespace App\Entity;

use App\Repository\CoureurRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoureurRepository::class)]
class Coureur
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $num_dossard = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_de_naissance = null;

    #[ORM\ManyToOne(inversedBy: 'coureurs')]
    #[ORM\JoinColumn(name: "code_pays", referencedColumnName: "code_pays", nullable: false)]
    private ?Pays $code_pays = null;

    #[ORM\ManyToOne(inversedBy: 'coureurs')]
    #[ORM\JoinColumn(name: "code_equipe", referencedColumnName: "code_equipe", nullable: false)]
    private ?Equipe $code_equipe = null;

    #[ORM\OneToMany(targetEntity: Resultat::class, mappedBy: 'coureur')]
    private Collection $id_resultat;

    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'vainqueur')]
    private Collection $vainqueur;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etape")
     */
    private $etapes;

    public function __construct()
    {
        $this->id_resultat = new ArrayCollection();
        $this->vainqueur = new ArrayCollection();
    }

    public function getNumDossard(): ?int
    {
        return $this->num_dossard;
    }

    public function setNumDossard(int $num_dossard): static
    {
        $this->num_dossard = $num_dossard;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): static
    {
        $this->date_de_naissance = $date_de_naissance;

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

    public function getCodeEquipe(): ?Equipe
    {
        return $this->code_equipe;
    }

    public function setCodeEquipe(?Equipe $code_equipe): static
    {
        $this->code_equipe = $code_equipe;

        return $this;
    }

    /**
     * @return Collection<int, Resultat>
     */
    public function getIdResultat(): Collection
    {
        return $this->id_resultat;
    }

    public function addIdResultat(Resultat $idResultat): static
    {
        if (!$this->id_resultat->contains($idResultat)) {
            $this->id_resultat->add($idResultat);
            $idResultat->setCoureur($this);
        }

        return $this;
    }

    public function removeIdResultat(Resultat $idResultat): static
    {
        if ($this->id_resultat->removeElement($idResultat)) {
            // set the owning side to null (unless already changed)
            if ($idResultat->getCoureur() === $this) {
                $idResultat->setCoureur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getVainqueur(): Collection
    {
        return $this->vainqueur;
    }

    public function addVainqueur(Etape $vainqueur): static
    {
        if (!$this->vainqueur->contains($vainqueur)) {
            $this->vainqueur->add($vainqueur);
            $vainqueur->setVainqueur($this);
        }

        return $this;
    }

    public function removeVainqueur(Etape $vainqueur): static
    {
        if ($this->vainqueur->removeElement($vainqueur)) {
            // set the owning side to null (unless already changed)
            if ($vainqueur->getVainqueur() === $this) {
                $vainqueur->setVainqueur(null);
            }
        }

        return $this;
    }
}
