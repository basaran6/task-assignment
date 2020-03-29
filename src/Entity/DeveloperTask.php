<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperTaskRepository")
 */
class DeveloperTask
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Developer", inversedBy="developerTasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $developer_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Task", inversedBy="yes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $task_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeveloperId(): ?Developer
    {
        return $this->developer_id;
    }

    public function setDeveloperId(?Developer $developer_id): self
    {
        $this->developer_id = $developer_id;

        return $this;
    }

    public function getTaskId(): ?Task
    {
        return $this->task_id;
    }

    public function setTaskId(Task $task_id): self
    {
        $this->task_id = $task_id;

        return $this;
    }
}
