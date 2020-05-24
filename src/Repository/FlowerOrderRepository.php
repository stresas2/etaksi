<?php

namespace App\Repository;

use App\Entity\FlowerOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlowerOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlowerOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlowerOrder[]    findAll()
 * @method FlowerOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerOrderRepository extends ServiceEntityRepository
{

    public const Rose = 0;

    public const Tulip = 1;

    public const Lily = 2;

    public const Bluebell = 3;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlowerOrder::class);
    }
}
