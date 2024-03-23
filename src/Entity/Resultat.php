<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultatRepository::class)]
class Resultat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $temps_parcouru = null;

    #[ORM\Column]
    private ?int $bonification = null;

    #[ORM\Column]
    private ?int $penalite = null;

    #[ORM\ManyToOne(inversedBy: 'id_resultat')]
    #[ORM\JoinColumn(name: "num_dossard", referencedColumnName: "num_dossard", nullable: false)]
    private ?Coureur $coureur = null;

    #[ORM\ManyToOne(inversedBy: 'resultat')]
    #[ORM\JoinColumn(name: "num_etape", referencedColumnName: "num_etape", nullable: false)]
    private ?Etape $etape = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempsParcouru(): ?\DateTimeInterface
    {
        return $this->temps_parcouru;
    }

    public function setTempsParcouru(\DateTimeInterface $temps_parcouru): static
    {
        $this->temps_parcouru = $temps_parcouru;

        return $this;
    }

    public function getBonification(): ?int
    {
        return $this->bonification;
    }

    public function setBonification(int $bonification): static
    {
        $this->bonification = $bonification;

        return $this;
    }

    public function getPenalite(): ?int
    {
        return $this->penalite;
    }

    public function setPenalite(int $penalite): static
    {
        $this->penalite = $penalite;
        return $this;
    }
    public function getCoureur(): ?Coureur
    {
        return $this->coureur;
    }

    public function setCoureur(?Coureur $coureur): static
    {
        $this->coureur = $coureur;

        return $this;
    }

    public function getEtape(): ?Etape
    {
        return $this->etape;
    }

    public function setEtape(?Etape $etape): static
    {
        $this->etape = $etape;

        return $this;
    }
}
