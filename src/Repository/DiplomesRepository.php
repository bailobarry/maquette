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
        $qb = $this->createQueryBuilder('d');

        $qb->select('ue.titre', 'c.descriptionConn', 'comp.descriptionComp')
            ->from(Diplomes::class, 'dip')
            ->leftJoin('dip.parcours', 'p')
            ->leftJoin('p.statut', 's')
            ->leftJoin('s.ues', 'ue')
            ->leftJoin('ue.connaissances', 'c')
            ->leftJoin('ue.competences', 'competences')
            ->where('d.nomDip LIKE :licence')
            ->setParameter('licence', '%licence%');

        return $qb->getQuery()->getResult();
    }

}
