<?php

namespace App\Repository;

use App\Entity\MCCRNE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MCCRNE>
 *
 * @method MCCRNE|null find($id, $lockMode = null, $lockVersion = null)
 * @method MCCRNE|null findOneBy(array $criteria, array $orderBy = null)
 * @method MCCRNE[]    findAll()
 * @method MCCRNE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MCCRNERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MCCRNE::class);
    }

//    /**
//     * @return MCCRNE[] Returns an array of MCCRNE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MCCRNE
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
