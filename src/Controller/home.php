<?php
namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class home extends AbstractController
{
    #[Route('/home')]
    public function hi()
    {
        $testValue = new Car('',[5.9,5.5,3.0,4.9,2.5,3.6],'');
        $form = $this->createFormBuilder($testValue)
        ->add('carName',TextType::class)
        ->add('carImage',TextType::class)
        ->add('save', SubmitType::class, ['label' => 'what ??'])
        ->getForm();
        $carList = [new Car('AlfaRomeo4CConcept',[5.9,5.5,3.0,4.9,2.5,3.6],'.\public\Images\bird.jpeg'),new Car('Alfa Romeo 4C Concept1',[5.9,5.5,3.0,4.9,2.5,3.6],''),new Car('Alfa Romeo 4C Concept2',[5.9,5.5,3.0,4.9,2.5,3.6],'')];
        return $this->render('car_list.html.twig',['carList'=>$carList, 'form'=>$form]);
    }
}