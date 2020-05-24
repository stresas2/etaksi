<?php

namespace App\Controller;

use App\Entity\CoffeOrder;
use App\Entity\FlowerOrder;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderJsonController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    /**
     * @return JsonResponse
     * @Route("/json", name="json", methods={"GET"})
     */
    public function Action(): JsonResponse
    {
        $coffee_orders = $this->entityManager->getRepository(CoffeOrder::class)->findAll();

        $data = [];

        foreach ($coffee_orders as $coffee_order){
            $order = [];
            $order['HasMilk'] = $coffee_order->getMilk();
            if($order['HasMilk'] === 1){
                $order['MilkType'] = $coffee_order->getMilkType();
            }
            $order['CupSize'] = $coffee_order->getCupSize();
            $order['Location'] = $coffee_order->getLocation();
            $order['OrderedAt'] = $coffee_order->getCreatedAt();

            $data[] = $order;
        }

        $flower_orders = $this->entityManager->getRepository(FlowerOrder::class)->findAll();

        foreach ($flower_orders as $flower_order){
            $order = [];
            $order['FlowerName'] = $flower_order->getName();

            $order['Address']['Country'] = $flower_order->getCountry();
            $order['Address']['City'] = $flower_order->getCity();
            $order['Address']['StreetAddress'] = $flower_order->getStreetAddress();
            $order['DeliverOn'] = $flower_order->getDeliverOn();

            $data[] = $order;
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}