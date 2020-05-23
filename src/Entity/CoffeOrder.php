<?php

namespace App\Entity;

use App\Repository\CoffeOrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeOrderRepository::class)
 */
class CoffeOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Milk;

    /**
     * @ORM\Column(type="integer")
     */
    private $MilkType;

    /**
     * @ORM\Column(type="integer")
     */
    private $CupSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMilk(): ?bool
    {
        return $this->Milk;
    }

    public function setMilk(bool $Milk): self
    {
        $this->Milk = $Milk;

        return $this;
    }

    public function getMilkType(): ?int
    {
        return $this->MilkType;
    }

    public function setMilkType(int $MilkType): self
    {
        $this->MilkType = $MilkType;

        return $this;
    }

    public function getCupSize(): ?int
    {
        return $this->CupSize;
    }

    public function setCupSize(int $CupSize): self
    {
        $this->CupSize = $CupSize;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }
}
