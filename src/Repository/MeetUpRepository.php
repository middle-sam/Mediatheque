<?php

namespace App\Repository;

use App\Entity\MeetUp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeetUp|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeetUp|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeetUp[]    findAll()
 * @method MeetUp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetUpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeetUp::class);
    }

    // /**
    //  * @return MeetUp[] Returns an array of MeetUp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MeetUp
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
