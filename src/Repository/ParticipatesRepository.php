<?php

namespace App\Repository;

use App\Entity\Participates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participates|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participates|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participates[]    findAll()
 * @method Participates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participates::class);
    }

    // /**
    //  * @return Participates[] Returns an array of Participates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Participates
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
