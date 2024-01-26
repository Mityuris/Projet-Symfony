<?php

namespace App\Entity;

use App\Repository\CarItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarItemRepository::class)]
class CarItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $carName = null;

    #[ORM\Column]
    private array $carStats = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $carImage = null;

    public function __construct($carName, $carStats, $carImage)
    {
        $this->setCarName($carName);
        $this->setCarStats($carStats);
        $this->setCarImage($carImage);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarName(): ?string
    {
        return $this->carName;
    }

    public function setCarName(string $carName): static
    {
        $this->carName = $carName;

        return $this;
    }

    public function getCarStats(): array
    {
        return $this->carStats;
    }

    public function setCarStats(array $carStats): static
    {
        $this->carStats = $carStats;

        return $this;
    }

    public function getCarImage(): ?string
    {
        return $this->carImage;
    }

    public function setCarImage(?string $carImage): static
    {
        $this->carImage = $carImage;

        return $this;
    }
}
