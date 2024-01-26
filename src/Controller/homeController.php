<?php

namespace App\Controller;

use App\Entity\CarItem;
use App\Entity\User;
use App\Repository\CarItemRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

class homeController extends AbstractController
{

    #[Route('')]
    public function redirectToHome()
    {
        return $this->redirect('home');
    }

    #[Route('firstBatch')]
    public function createInitCars(EntityManagerInterface $entityManager)
    {
        if (($baseCarsCsv = fopen('../baseCars.csv', 'r')) !== false) {
            while (($data = fgetcsv($baseCarsCsv, 1000, "~")) !== false) {
                $num = count($data);
                $newCar = new CarItem($data[0], $carstats = json_decode($data[1], true), '');
                $entityManager->persist($newCar);
                $entityManager->flush();
            }
            fclose($baseCarsCsv);
            return $this->render('home.html.twig');
        }
    }

    #[Route('home')]
    public function renderHome()
    {
        return $this->render('home.html.twig');
    }

    #[Route('createCar')]
    public function createCarItem(EntityManagerInterface $entityManager)
    {
        $testCar = new CarItem('AlfaRomeo4CConcept', [5.9, 5.5, 3.0, 4.9, 2.5, 3.6], '');
        $entityManager->persist($testCar);
        $entityManager->flush();
        return $this->render('home.html.twig');
    }

    #[Route('car-list')]
    public function renderCarList(Request $request, CarItemRepository $carItemRepository)
    {
        $pageNumber = $request->query->get('pageNumber', 1);
        $carList = [];
        $carList = $carItemRepository->getAllCars($pageNumber, 10);
        if (sizeof($carList) == 0) {
            return $this->render('car_list.html.twig', ['carList' => "Nothing here bucko!"]);
        }
        return $this->render('car_list.html.twig', ['carList' => $carList, 'numberOfCars' => $carItemRepository->getNumberOfCars()]);
    }

    #[Route('car-upload', 'car-upload')]
    public function uploadCar(Request $request, EntityManagerInterface $entityManager)
    {
        $carImage = $request->files->get('car-image');
        $destination = $this->getParameter('kernel.project_dir') . '/public/Uploads';
        $newFileName = uniqid().'~'.$carImage->getClientOriginalName();
        // dd($carImage->move($destination,$newFileName));
        $car = $request->request->all();
        $newCar = new CarItem($car['CarName'], [$car['acceleration'], $car['top-speed'], $car['control'], $car['weight'], $car['off-road'], $car['toughness']], $newFileName);
        $entityManager->persist($newCar);
        // var_dump($newCar);
        $entityManager->flush();
        return $this->redirectToRoute('app_home_redirecttohome');
    }

    #[Route('car-creation', 'car-creation')]
    public function renderCarCreation(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('CarName', TextType::class, ['attr' => ['name' => 'car-name', 'id' => 'car-name', 'placeholder' => 'car name']])
            ->add('Acceleration', RangeType::class, ['attr' => ['name' => 'acceleration', 'id' => 'acceleration', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('TopSpeed', RangeType::class, ['attr' => ['name' => 'top-speed', 'id' => 'Top-speed', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('Control', RangeType::class, ['attr' => ['name' => 'control', 'id' => 'control', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('Weight', RangeType::class, ['attr' => ['name' => 'weight', 'id' => 'weight', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('Off-Road', RangeType::class, ['attr' => ['name' => 'off-road', 'id' => 'off-road', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('Toughness', RangeType::class, ['attr' => ['name' => 'toughness', 'id' => 'toughness', 'min' => "0", 'max' => "10", 'step' => "0.1", 'oninput' => "this.nextElementSibling.value = this.value"]])
            ->add('CarImage', FileType::class, ['attr' => ['id' => "car-image", 'name' => "car-image"]])
            ->add('create', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
        return $this->render('car_creation.html.twig', ['form' => $form]);
    }

    #[Route('map')]
    public function renderMap()
    {
        return $this->render('map.html.twig');
    }
}
