<?php

namespace App\Repository;

use App\Entity\Diplomes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Diplomes>
 *
 * @method Diplomes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diplomes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diplomes[]    findAll()
 * @method Diplomes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiplomesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diplomes::class);
    }

    public function findUesDiplomes(): array
    {
        $qb = $this->createQueryBuilder('d')
            ->select('ue.titre AS titreUe', 'bc.nomBlocConn', 'bcomp.nomBlocComp')
            ->from('App\Entity\Diplomes', 'd')
            ->leftJoin('d.parcours', 'p')
            ->leftJoin('p.ues', 'ue')
            ->leftJoin('ue.blocConnaissances', 'bc')
            ->leftJoin('ue.competences', 'bcomp')
            ->where('d.nomDip LIKE :name')
            ->setParameter('name', 'licence%');

        return $qb->getQuery()->getResult();
    }

}
