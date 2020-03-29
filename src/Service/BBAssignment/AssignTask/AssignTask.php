<?php 

namespace App\Service\BBAssignment\AssignTask;

use App\Repository\DeveloperRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManager;

abstract class AssignTask
{
    protected $taskRepository;
    protected $developerRepository;
    protected $entityManager;
    
    public function __construct(TaskRepository $taskRepository, DeveloperRepository $developerRepository, EntityManager $entityManager)
    {
        $this->taskRepository = $taskRepository;
        $this->developerRepository = $developerRepository;    
        $this->entityManager = $entityManager;
    }
}