<?php

namespace App\Controller;

use App\Entity\Figures;
use App\Repository\FiguresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     *@Route("/", name="home")
     */

    public function index(FiguresRepository $repo)
    {
        $figures =$repo->findAll();

        return $this->render('home/index.html.twig', [
            'figures' => $figures
        ]);
    }

    /**
     *@Route("/create", name="create")
     */

    public function create(Request $request, EntityManagerInterface $manager)
    {
        $figure = new Figures();

        $form = $this->createFormBuilder($figure)
                     ->add('title')
                     ->add('content')
                     ->add('users')
                     ->add('category')
                     ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $figure->setCreatedAt(new \DateTime());
            $manager->persist($figure);
            $manager->flush();
        }

        return $this->render('home/create.html.twig', [
            'formFigure' => $form->createView()
        ]);
    }
}
