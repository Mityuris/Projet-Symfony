<?php

namespace App\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Mapping as ORM;

use function PHPSTORM_META\type;

#[ORM\Entity]
#[ORM\Table(name:'entityTests')]
class entityTest
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type:'string')]
    private string $name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
