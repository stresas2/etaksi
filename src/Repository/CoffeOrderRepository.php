<?php

namespace App\Repository;

use App\Entity\CoffeOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoffeOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoffeOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoffeOrder[]    findAll()
 * @method CoffeOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoffeOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoffeOrder::class);
    }

    // /**
    //  * @return CoffeOrder[] Returns an array of CoffeOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoffeOrder
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
