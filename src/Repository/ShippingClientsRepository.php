<?php

namespace App\Repository;

use App\Entity\ShippingClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingClients[]    findAll()
 * @method ShippingClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingClients::class);
    }

    // /**
    //  * @return ShippingClients[] Returns an array of ShippingClients objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShippingClients
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
