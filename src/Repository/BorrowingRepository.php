<?php

namespace App\Repository;
use App\Entity\Borrowing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Borrowing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrowing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrowing[]    findAll()
 * @method Borrowing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrowing::class);
    }




    /**
     * @return Borrowing[] returns an array of the most borrowed documents last month
     */
    public function findMostBorrowed(){

        return  $this->createQueryBuilder('lb')

            ->select('lb')
            ->where("lb.startDate > DATESUB(CURRENT_DATE(), 1, 'MONTH')")
            ->groupBy('lb.id')
            ->getQuery()
            ->getResult();
    }

    public function findExpiredBorrowings(){

        $expireBorrowings =  $this->createQueryBuilder('xp')
            ->select('xp')
            ->where('xp.expectedReturnDate < CURRENT_DATE()')
            ->groupBy('xp.memberId')
            ->orderBy('xp.expectedReturnDate', 'ASC')
            ->getQuery()
            ->getResult();
        return $expireBorrowings;
    }
//'SELECT * FROM member INNER JOIN borrowing ON member.id = borrowing.member_id_id'

    public function findExpiredBorrowingsByMember(){

        return  $this->createQueryBuilder('xpm')
            ->select('xpm')
            //Inner join n'est pas necessaire ici, symfony fait la jointure entre les tables par l'alias 'm'
            //->innerJoin(
            //    'xpm.memberId',
            //    'm'
            //)
            ->andwhere('xpm.expectedReturnDate < CURRENT_DATE()')
            ->andWhere('xpm.effectiveReturnDate IS NULL')
            ->orderBy('xpm.id', 'ASC')
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return Borrowing[] Returns an array of Borrowing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Borrowing
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
