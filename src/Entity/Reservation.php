<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table(name: 'reservation')] 
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue] 
    #[ORM\Column(name: "num_reservation", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "date_reservation", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(name: "date_debut_reservation", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutReservation = null;

    #[ORM\Column(name: "date_fin_reservation", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinReservation = null;

    #[ORM\Column(name: "nb_personnes_reservation")]
    private ?int $nbPersonnesReservation = null;

    #[ORM\ManyToOne(targetEntity: Studio::class)]
    #[ORM\JoinColumn(name: "num_studio", referencedColumnName: "num_studio", nullable: false)]
    private ?Studio $studio = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(
        name: "id_user",          
        referencedColumnName: "id_user", 
        nullable: false
    )]
    private ?Client $client = null;

    public function getId(): ?int { return $this->id; }

    public function getDateReservation(): ?\DateTimeInterface { return $this->dateReservation; }
    public function setDateReservation(\DateTimeInterface $dateReservation): self { $this->dateReservation = $dateReservation; return $this; }

    public function getDateDebutReservation(): ?\DateTimeInterface { return $this->dateDebutReservation; }
    public function setDateDebutReservation(\DateTimeInterface $dateDebutReservation): self { $this->dateDebutReservation = $dateDebutReservation; return $this; }

    public function getDateFinReservation(): ?\DateTimeInterface { return $this->dateFinReservation; }
    public function setDateFinReservation(\DateTimeInterface $dateFinReservation): self { $this->dateFinReservation = $dateFinReservation; return $this; }

    public function getNbPersonnesReservation(): ?int { return $this->nbPersonnesReservation; }
    public function setNbPersonnesReservation(int $nbPersonnesReservation): self { $this->nbPersonnesReservation = $nbPersonnesReservation; return $this; }

    public function getStudio(): ?Studio { return $this->studio; }
    public function setStudio(?Studio $studio): self { $this->studio = $studio; return $this; }

    public function getClient(): ?Client { return $this->client; }
    public function setClient(?Client $client): self { $this->client = $client; return $this; }
}