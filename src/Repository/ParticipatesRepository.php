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

//SELECT meet_up_id_id, SUM(places) FROM participates GROUP BY meet_up_id_id
// SELECT SUM(spm.places) FROM App\Entity\Participates spm INNER JOIN CreatorId m, participates p WHERE m.id = :id
    /**
     * Calcul du nombre de réservations par meetup
     * @param $meetUpId
     * @return int|mixed|string
     */
    public function sumOfPlacesByMeetup($meetUpId){

        return  $this->createQueryBuilder('spm')
            ->select('SUM(spm.places)')
            ->innerJoin('spm.meetUpId', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $meetUpId)
            ->groupBy('m.id')
            ->getQuery()
            ->getResult();
    }

    public function findParticipatesByMeetup($meetUpId){


        return $this->createQueryBuilder('pm')
            ->select('pm')
            ->where('m.id = :id')
            ->setParameter('id', $meetUpId)
            ->getQuery()
            ->getResult();
    }

    public function findAllByMeetUp(){
        return $this->createQueryBuilder('am')
            //->where('am.id = :id')
            //->setParameter('id', $meetUpId)
            ->orderBy('am.id', 'ASC')
            ->groupBy('am.meetUpId')
            ->getQuery()
            ->getResult();
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
