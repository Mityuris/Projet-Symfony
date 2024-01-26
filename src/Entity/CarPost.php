<?php

namespace App\Entity;

use App\Repository\CarPostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarPostRepository::class)]
class CarPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $carItemId = null;

    #[ORM\Column(length: 50)]
    private ?string $carCreator = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarItemId(): ?int
    {
        return $this->carItemId;
    }

    public function setCarItemId(int $carItemId): static
    {
        $this->carItemId = $carItemId;

        return $this;
    }

    public function getCarCreator(): ?string
    {
        return $this->carCreator;
    }

    public function setCarCreator(string $carCreator): static
    {
        $this->carCreator = $carCreator;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
