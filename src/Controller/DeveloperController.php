<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Form\DeveloperType;
use App\Repository\DeveloperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperController extends AbstractController
{
    protected $repository;
    public function __construct(DeveloperRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/developer", name="developer")
     */
    public function index()
    {
        $developers = $this->repository->findAll();
        return $this->render('developer/index.html.twig', [
            'developers' => $developers,
        ]);
    }

    /**
     * @Route("/developer/new", name="new_developer")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(DeveloperType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $developerFormData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($developerFormData);
            $entityManager->flush();
            $this->addFlash('success', 'Yeni developer eklendi!');
            return $this->redirectToRoute('developer');
        }
        return $this->render('developer/edit.html.twig', [
            'developer_form' => $form->createView(),
        ]);
    }

}
