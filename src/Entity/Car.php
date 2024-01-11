<?php
namespace App\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Car extends AbstractController
{
    private $id;
    private $carName;
    private $carStats;
    private $carImage;

    public function __construct($carName, $carStats, $carImage) {
        $this->setCarName($carName);
        $this->setCarStats($carStats);
        $this->setCarImage($carImage);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCarName()
    {
        return $this->carName;
    }

    public function setCarName($carName)
    {
        $this->carName = $carName;

        return $this;
    }

    public function getCarStats()
    {
        return $this->carStats;
    }

    public function setCarStats($carStats)
    {
        $this->carStats = $carStats;

        return $this;
    }

    public function getCarImage()
    {
        return $this->carImage;
    }

    public function setCarImage($carImage)
    {
        $this->carImage = $carImage;

        return $this;
    }
}
