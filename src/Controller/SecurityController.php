<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SecurityController extends AbstractController
{
    #[Route('register')]
    public function renderRegister(Request $request, UserRepository $userItemRepository, EntityManagerInterface $entityManager)
    {
        $form = $this->createFormBuilder()
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('create', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userExists = $userItemRepository->findOneBy(['username' => $user['username']]);
            if ($userExists == true) {
                echo "This user already exists";
            } else {
                $newUser = new User($user['username'], $user['password'], ['basicUser']);
                $entityManager->persist($newUser);
                $entityManager->flush();
                return $this->redirectToRoute('app_home_redirecttohome');
            }
        }
        return $this->render('register.html.twig', ['form' => $form]);
    }

    #[Route('login')]
    public function renderLogin()
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_home_redirecttohome');
        } else {
            return $this->render('login.html.twig');
        }
    }

    #[Route('logout')]
    public function logout()
    {
        throw new \Exception('logout() should never be reached');
    }
}
