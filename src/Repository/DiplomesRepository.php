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

    public function findUesByLicenceName(): array
    {
        $qb = $this->createQueryBuilder('d')
            ->select('d', 'parc', 'ue', 'comp', 'conn')
            ->innerJoin('d.parcours', 'parc')
            ->innerJoin('parc.statut', 'statut')
            ->innerJoin('statut.ues', 'ue')
            ->leftJoin('ue.competences', 'comp')
            ->leftJoin('ue.connaissances', 'conn')
            ->where('d.nomDip LIKE :licence')
            ->setParameter('licence', '%licence%');

        return $qb->getQuery()->getResult();
    }


}
