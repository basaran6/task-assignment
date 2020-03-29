<?php

namespace App\Repository;

use App\Entity\DeveloperTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DeveloperTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeveloperTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeveloperTask[]    findAll()
 * @method DeveloperTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeveloperTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeveloperTask::class);
    }

    // /**
    //  * @return DeveloperTask[] Returns an array of DeveloperTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeveloperTask
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
