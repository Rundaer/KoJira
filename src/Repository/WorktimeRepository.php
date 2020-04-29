<?php

namespace App\Repository;

use App\Entity\Worktime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Worktime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Worktime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Worktime[]    findAll()
 * @method Worktime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorktimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worktime::class);
    }

    // /**
    //  * @return Worktime[] Returns an array of Worktime objects
    //  */
    
    public function findAllExtend()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT w FROM App:Worktime w ORDER BY w.id ASC')
            ->getResult();
    }
    

    /*
    public function findOneBySomeField($value): ?Worktime
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
