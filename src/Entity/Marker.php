<?php

namespace App\Entity;

use App\Repository\MarkerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarkerRepository::class)]
class Marker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $markerType = null;

    #[ORM\Column]
    private array $mapCoordinates = [];

    public function __construct($markerType, $mapCoordinates)
    {
        $this->setMarkerType($markerType);
        $this->setMapCoordinates($mapCoordinates);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarkerType(): ?string
    {
        return $this->markerType;
    }

    public function setMarkerType(string $markerType): static
    {
        $this->markerType = $markerType;

        return $this;
    }

    public function getMapCoordinates(): array
    {
        return $this->mapCoordinates;
    }

    public function setMapCoordinates(array $mapCoordinates): static
    {
        $this->mapCoordinates = $mapCoordinates;

        return $this;
    }
}
