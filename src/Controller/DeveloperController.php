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
     * @Route("/developer/new", name="developer_new")
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

    

    /**
     * @Route("/developer/{id}", name="developer_show")
     */
    public function show($id)
    {
        $developer = $this->repository->find($id);
        if(!$developer){
            $this->addFlash('danger', "$id'li developer sistemde yok!");
            return $this->redirectToRoute('developer');
        }
        return $this->render('developer/detail.html.twig', [
            'developer' =>  $developer
        ]);
    }

        /**
     * @Route("/developer/{id}/edit", name="developer_edit")
     */
    public function edit(Request $request, Developer $developer)
    {

        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('developer');
        }

        return $this->render('developer/edit.html.twig', [
            'developer' => $developer,
            'developer_form' => $form->createView(),
        ]);
    }


}
