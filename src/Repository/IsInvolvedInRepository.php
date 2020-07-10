<?php

namespace App\Repository;

use App\Entity\IsInvolvedIn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IsInvolvedIn|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsInvolvedIn|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsInvolvedIn[]    findAll()
 * @method IsInvolvedIn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsInvolvedInRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IsInvolvedIn::class);
    }

    // /**
    //  * @return IsInvolvedIn[] Returns an array of IsInvolvedIn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IsInvolvedIn
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
