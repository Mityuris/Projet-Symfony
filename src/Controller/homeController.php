<?php

namespace App\Controller;

use App\Entity\CarItem;
use App\Repository\CarItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController
{

    #[Route('')]
    public function redirectToHome()
    {
        return $this->redirect('home');
    }

    #[Route('createCar')]
    public function createCarItem(EntityManagerInterface $entityManager)
    {
        $testCar = new CarItem('AlfaRomeo4CConcept', [5.9, 5.5, 3.0, 4.9, 2.5, 3.6], '');
        $entityManager->persist($testCar);
        $entityManager->flush();
        return $this->render('home.html.twig');
    }

    #[Route('home')]
    public function renderHome()
    {
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


        // while ($carItemRepository|| $carId>$endOfPageId) {
        //     array_push($carList, $entityManager->getRepository(CarItem::class)->find($carId));
        //     $carId++;
        // }
        return $this->render('car_list.html.twig', ['carList' => $carList,'numberOfCars'=>$carItemRepository->getNumberOfCars()]);
    }
}
