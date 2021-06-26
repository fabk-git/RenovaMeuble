<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Meuble::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $meuble;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * Propriété qui contient le pris total d'une ligne de panier
     * (non mappé en BDD)
     */
    private $lineAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMeuble(): ?Meuble
    {
        return $this->meuble;
    }

    public function setMeuble(?Meuble $meuble): self
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getLineAmount(){
        return $this->lineAmount;
    }

    public function setLineAmount(float $amount){
        $this->lineAmount = $amount;
    }
}
