<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperRepository")
 */
class Developer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeveloperTask", mappedBy="developer")
     */
    private $developerTasks;

    /**
     * @ORM\Column(type="integer")
     */
    private $weekly_working_hour = 45;

    public function __construct()
    {
        $this->developerTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    /**
     * @return Collection|DeveloperTask[]
     */
    public function getDeveloperTasks(): Collection
    {
        return $this->developerTasks;
    }

    public function addDeveloperTask(DeveloperTask $developerTask): self
    {
        if (!$this->developerTasks->contains($developerTask)) {
            $this->developerTasks[] = $developerTask;
            $developerTask->setDeveloper($this);
        }

        return $this;
    }

    public function removeDeveloperTask(DeveloperTask $developerTask): self
    {
        if ($this->developerTasks->contains($developerTask)) {
            $this->developerTasks->removeElement($developerTask);
            // set the owning side to null (unless already changed)
            if ($developerTask->getDeveloper() === $this) {
                $developerTask->setDeveloper(null);
            }
        }

        return $this;
    }

    public function getWeeklyWorkingHour(): ?int
    {
        return $this->weekly_working_hour;
    }

    public function setWeeklyWorkingHour(int $weekly_working_hour): self
    {
        $this->weekly_working_hour = $weekly_working_hour;

        return $this;
    }

    public function getWeeklyTaskPoint()
    {
        return $this->getLevel() * $this->getWeeklyWorkingHour();
    }
    public function getTotalAssignedTaskPoint()
    {
        $assignedTasks = $this->getDeveloperTasks();
        $taskPoints = 0;
        foreach($assignedTasks as $assignedTask) {
            $task = $assignedTask->getTask();
            $taskPoint = $task->getLevel() * $task->getEstimatedDuration();
            $taskPoints += $taskPoint;
        }
        return $taskPoints;
    }
}
