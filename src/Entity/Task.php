<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $estimated_duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provider_name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DeveloperTask", mappedBy="task_id", cascade={"persist", "remove"})
     */
    private $developerTask;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $task_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getEstimatedDuration(): ?int
    {
        return $this->estimated_duration;
    }

    public function setEstimatedDuration(int $estimated_duration): self
    {
        $this->estimated_duration = $estimated_duration;

        return $this;
    }

    public function getProviderName(): ?string
    {
        return $this->provider_name;
    }

    public function setProviderName(string $provider_name): self
    {
        $this->provider_name = $provider_name;

        return $this;
    }

    public function getDeveloperTask(): ?DeveloperTask
    {
        return $this->developerTask;
    }

    public function setDeveloperTask(DeveloperTask $developerTask): self
    {
        $this->developerTask = $developerTask;

        // set the owning side of the relation if necessary
        if ($developerTask->getTaskId() !== $this) {
            $developerTask->setTaskId($this);
        }

        return $this;
    }

    public function getTaskId(): ?string
    {
        return $this->task_id;
    }

    public function setTaskId(string $task_id): self
    {
        $this->task_id = $task_id;

        return $this;
    }
}
