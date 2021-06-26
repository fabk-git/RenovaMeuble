<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Meuble::class, mappedBy="categories")
     */
    private $meubles;

    public function __construct()
    {
        $this->meubles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Meuble[]
     */
    public function getMeubles(): Collection
    {
        return $this->meubles;
    }

    public function addMeuble(Meuble $meuble): self
    {
        if (!$this->meubles->contains($meuble)) {
            $this->meubles[] = $meuble;
            $meuble->addCategory($this);
        }

        return $this;
    }

    public function removeMeuble(Meuble $meuble): self
    {
        if ($this->meubles->removeElement($meuble)) {
            $meuble->removeCategory($this);
        }

        return $this;
    }
}
