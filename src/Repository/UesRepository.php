<?php

namespace App\Repository;

use App\Entity\Ues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ues>
 *
 * @method Ues|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ues|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ues[]    findAll()
 * @method Ues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ues::class);
    }

//    /**
//     * @return Ues[] Returns an array of Ues objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ues
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
