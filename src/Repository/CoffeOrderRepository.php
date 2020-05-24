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
    public const WithMilk = 1;

    public const WithoutMilk = 0;

    public const Cappuccino = 0;

    public const Latte = 1;

    public const Macchiato = 2;

    public const OneHundred = 0;

    public const TwoHundred = 1;

    public const ThreeHundred = 2;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoffeOrder::class);
    }
}
