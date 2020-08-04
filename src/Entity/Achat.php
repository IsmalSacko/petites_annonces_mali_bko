<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use DateInterval;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\AST\Functions\DateAddFunction;
use Faker;

/**
 * @ORM\Entity(repositoryClass=AchatRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Achat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $acheteur;

    /**
     * @ORM\ManyToOne(targetEntity=Annonces::class, inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $date = new \DateTime();
        if (empty($this->createdAt)){
            $this->createdAt = $date;
        }
        if (empty($this->startdate)){
            $this->startdate =$date;
        }
        if (empty($this->endDate)){
            $faker = Faker\Factory::create('fr_FR');

            $this->endDate = $faker->dateTimeInInterval($date =  '+ 1 days');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcheteur(): ?User
    {
        return $this->acheteur;
    }

    public function setAcheteur(?User $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    public function getAnnonce(): ?Annonces
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonces $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
