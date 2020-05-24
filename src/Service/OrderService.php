<?php

namespace App\Service;

use App\Entity\CoffeOrder;
use App\Entity\FlowerOrder;
use App\Repository\CoffeOrderRepository;
use App\Repository\FlowerOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    public function OrderInJson()
    {
        $coffee_orders = $this->entityManager->getRepository(CoffeOrder::class)->findAll();

        $data = [];

        foreach ($coffee_orders as $coffee_order) {
            $order = [];
            $order['HasMilk'] = $coffee_order->getMilk();
            if ($order['HasMilk'] === true) {
                $milk_type = $coffee_order->getMilkType();
                $order['MilkType'] = $this->MilkTypeName($milk_type);
            }
            $cup_size = $coffee_order->getCupSize();
            $order['CupSize'] = $this->CupSizeName($cup_size);
            $order['Location'] = $coffee_order->getLocation();
            $order['OrderedAt'] = $coffee_order->getCreatedAt();

            $data[] = $order;
        }

        $flower_orders = $this->entityManager->getRepository(FlowerOrder::class)->findAll();

        foreach ($flower_orders as $flower_order) {
            $order = [];
            $flower_name = $flower_order->getName();
            $order['FlowerName'] = $this->FlowerName($flower_name);
            $order['Address']['Country'] = $flower_order->getCountry();
            $order['Address']['City'] = $flower_order->getCity();
            $order['Address']['StreetAddress'] = $flower_order->getStreetAddress();
            $order['DeliverOn'] = $flower_order->getDeliverOn();

            $data[] = $order;
        }

        return $data;
    }

    public function MilkTypeName(int $milk_type): string
    {

        if ($milk_type === CoffeOrderRepository::Cappuccino) {
            return 'Cappuccino';
        } elseif ($milk_type === CoffeOrderRepository::Macchiato) {
            return 'Macchiato';
        } elseif ($milk_type === CoffeOrderRepository::Latte) {
            return 'Latte';
        }

        return 'not found';
    }

    public function CupSizeName(int $cup_type): string
    {

        if ($cup_type === CoffeOrderRepository::OneHundred) {
            return '100 ml';
        } elseif ($cup_type === CoffeOrderRepository::TwoHundred) {
            return '200 ml';
        } elseif ($cup_type === CoffeOrderRepository::ThreeHundred) {
            return '300 ml';
        }

        return 'not found';
    }

    public function FlowerName(int $flower): string
    {

        if ($flower === FlowerOrderRepository::Bluebell) {
            return 'Bluebell';
        } elseif ($flower === FlowerOrderRepository::Lily) {
            return 'Lily';
        } elseif ($flower === FlowerOrderRepository::Tulip) {
            return 'Tulip';
        } elseif ($flower === FlowerOrderRepository::Rose) {
            return 'Rose';
        }

        return 'not found';
    }
}