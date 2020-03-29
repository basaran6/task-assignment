<?php 

namespace App\Service\BBAssignment;

use App\Entity\DeveloperTask;
use App\Service\BBAssignment\AssignTask\AssignTask;
use App\Service\BBAssignment\AssignTask\IAssignTask;

class CustomAssignTask extends AssignTask implements IAssignTask
{
    public function assignAppropriate($developer, $point, $sequence)
    {
        $task = $this->getTasks('DESC', true, $point)[0] ?? null;
        if(!$task){
            $task = $this->getTasks('ASC')[0] ?? null;
        }
        if($task) {
            $taskPoint = $task->getLevel() * $task->getEstimatedDuration();
            $point = $point - $taskPoint;
            $developerTask = new DeveloperTask();
            $developerTask->setDeveloper($developer)->setTask($task)->setSequence($sequence);
            $this->entityManager->persist($developerTask);
            $this->entityManager->flush();
            if($point > 0) {
                $this->assignAppropriate($developer, $point, ++$sequence);
            }
        }
    }

    public function getTasks($sortCriteria ='DESC', $pointCriteria=false, $point=0)
    {
        $taskBaseQuery = $this->taskRepository->createQueryBuilder('t');
        $taskBaseQuery->leftJoin('t.developerTask', 'dt');
        $taskBaseQuery->where('dt.id is null');
        if($pointCriteria){
            $taskBaseQuery->where('t.level*t.estimated_duration <= :point');
            $taskBaseQuery->setParameter('point', $point);
        }
        $taskBaseQuery->orderBy('t.level*t.estimated_duration', $sortCriteria);
        $tasks = $taskBaseQuery->getQuery()->getResult();
        return $tasks;
    }
    public function assign(): bool 
    {
        $status = true;
        $taskTotalPoint = $this->taskRepository->createQueryBuilder('t')->select("sum(t.level*t.estimated_duration) as point")->getQuery()->getResult()[0]['point'] ?? 1;
        $developerTotalPoint = $this->developerRepository->createQueryBuilder('d')->select("sum(d.level*d.weekly_working_hour) as point")->getQuery()->getResult()[0]['point'] ?? 1;
        $developers = $this->developerRepository->createQueryBuilder('d')->orderBy('d.level*d.weekly_working_hour', 'DESC')->getQuery()->getResult();
        $totalAverage = ($taskTotalPoint / $developerTotalPoint);
        foreach($developers as $developer)
        {
            $sequence = 0;
            $remainingPoint = $developer->getLevel() * $developer->getWeeklyWorkingHour() * $totalAverage;
            foreach($this->getTasks() as $task)
            {
                $taskPoint = $task->getLevel() * $task->getEstimatedDuration();
                $remainingPoint = $remainingPoint - $taskPoint;
                if($remainingPoint < 0){
                    $this->entityManager->flush();
                    $this->assignAppropriate($developer, ($remainingPoint+$taskPoint), $sequence);
                }
                else if($remainingPoint >= 0)
                {
                    $developerTask = new DeveloperTask();
                    $developerTask->setDeveloper($developer)->setTask($task)->setSequence($sequence);
                    $this->entityManager->persist($developerTask);
                }
                if($remainingPoint <= 0) {
                    $this->entityManager->flush();
                    break;
                }
                $sequence++;
            }
            $this->entityManager->flush();
        }
        return $status;
    }
}