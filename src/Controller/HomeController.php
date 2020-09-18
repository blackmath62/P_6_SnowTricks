<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     *@Route("/", name="home")
     */

    public function index(TricksRepository $repo)
    {
        $Tricks =$repo->findAll();

        return $this->render('home/index.html.twig', [
            'Tricks' => $Tricks
        ]);
    }

    /**
     *@Route("/create", name="create")
     */

    public function create(Request $request, EntityManagerInterface $manager)
    {
        $Trick = new Tricks();

        $form = $this->createFormBuilder($Trick)
                     ->add('title')
                     ->add('content')
                     ->add('users')
                     ->add('category')
                     ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $Trick->setCreatedAt(new \DateTime());
            $manager->persist($Trick);
            $manager->flush();
        }

        return $this->render('home/create.html.twig', [
            'formTrick' => $form->createView()
        ]);
    }
}
