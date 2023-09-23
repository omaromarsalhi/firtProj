<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/users', name: 'user_')]
class UsersController extends AbstractController
{
    // #[Route('/users', name: 'users')]
    // public function users(): Response
    // {
    //     return $this->render('users/index.html.twig', [
    //         'controller_name' => 'UsersController',
    //     ]);
    // }


    #[Route('/create', name: 'create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // creating an object and filling it wigth the informations
        $user=new Users();
        $user->setFirstName("omar");
        $user->setLastName("salhi");
        $user->setEmail("omar.salhi@esprit.tn");
        $user->setAge(21);
        $user->setCin(12710434);

        // creating the entity manager
        $entityManager->persist($user);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new Response('Saved new user with name '.$user->getFirstName());
    }

    #[Route('/show', name: 'show')]
    public function show(UsersRepository $entityController): Response
    {
        $users=$entityController->findAll();
        return $this->render('users/show.html.twig', [
                    'users' => $users,
                ]);
    }
}
