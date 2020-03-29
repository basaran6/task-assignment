<?php 

namespace App\Command;

use App\Entity\Developer;
use App\Entity\Task;
use App\Service\BBAssignment\CustomAssignTask;
use App\Service\BBProvider\ProviderServices\TaskProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TaskFromProviderCommand extends Command
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }


    protected function configure()
    {
        $this
            ->setName('app:get-task-from-providers')
            ->setHelp('php bin/console app:task-from-providers komutunu çalıştırarak kullanabilirsiniz.')
            ->addOption('get-and-assign-tasks', null, InputOption::VALUE_OPTIONAL, 'Taskları endpointlerden aldıktan sonra otomatik developerların üzerine atar.', false)
            ->addOption('only-assign-tasks', null, InputOption::VALUE_OPTIONAL, 'Task verisi çekme işlemini yapmaz, sadece task atar..', false)
            ->setDescription('İlgili providerlardan taskları çekerek sisteme dahil eder.');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Komut çalışmaya başladı.");

        $optionValue = $input->getOption('only-assign-tasks');
        $onlyAssignTasks = ($optionValue !== false);

        $optionValue = $input->getOption('get-and-assign-tasks');
        $getAndAssignTasks = ($optionValue !== false);

        $entityManager = $this->container->get('doctrine')->getManager();
        if(!$onlyAssignTasks){
            $taskProvider = new TaskProvider();
            $output->writeln("Tasklar providerlardan almaya başladı.");
            $tasks = $taskProvider->getAllTasks();
            $output->writeln("Tasklar providerlardan alındı.");
            $output->writeln("Tasklar veritabanına kaydediliyor.");
            $newTask = 0;
            $totalTask = count($tasks);
            foreach($tasks as $task){
                $taskEntity = $this->container->get('doctrine')->getRepository(Task::class)->findBy(array('task_id' => $task['id'], 'provider_name' => $task['provider_name']))[0] ?? null;
                if(!$taskEntity){
                    $taskEntity = new Task();
                    $newTask++;
                }
                $taskEntity->setTaskId($task['id']);
                $taskEntity->setLevel($task['level']);
                $taskEntity->setEstimatedDuration($task['estimated_duration']);
                $taskEntity->setProviderName($task['provider_name']);
                $entityManager->persist($taskEntity);
                $entityManager->flush();
            }
            $output->writeln("$totalTask adet task için işlem yapıldı ve $newTask adet yeni task veritabanına kaydedildi.", false);
        }
        if($getAndAssignTasks || $onlyAssignTasks){
            $output->writeln("İşler atanıyor.");
            $customAssign = new CustomAssignTask(
                $this->container->get('doctrine')->getRepository(Task::class),
                $this->container->get('doctrine')->getRepository(Developer::class),
                $entityManager
            );
            if($customAssign->assign()){
                $output->writeln("İşler atandı");
            }
            else {
                $output->writeln("İşler atanmadı!");
            }
        }
        $output->writeln("Komut çalışmayı tamamladı..");
    }
}