<?php

namespace App\Repository;

use App\Entity\BlocsConnaissances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlocsConnaissances>
 *
 * @method BlocsConnaissances|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocsConnaissances|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocsConnaissances[]    findAll()
 * @method BlocsConnaissances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocsConnaissancesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocsConnaissances::class);
    }

//    /**
//     * @return BlocsConnaissances[] Returns an array of BlocsConnaissances objects
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

//    public function findOneBySomeField($value): ?BlocsConnaissances
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
