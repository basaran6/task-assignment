<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    protected $repository;
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/task", name="task")
     */
    public function index()
    {
        $tasks = $this->repository->findAll();
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * @Route("/task/unassign-all", name="task_unassign")
     */
    public function unassign()
    {
        $manager = $this->getDoctrine()->getManager();
        $q = $manager->createQuery('delete from  App\Entity\DeveloperTask');
        $q->execute();
        return $this->redirectToRoute('developer');
    }
    
}
