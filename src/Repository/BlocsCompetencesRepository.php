<?php

namespace App\Repository;

use App\Entity\BlocsCompetences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlocsCompetences>
 *
 * @method BlocsCompetences|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocsCompetences|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocsCompetences[]    findAll()
 * @method BlocsCompetences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocsCompetencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocsCompetences::class);
    }

//    /**
//     * @return BlocsCompetences[] Returns an array of BlocsCompetences objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BlocsCompetences
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
