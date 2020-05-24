<?php

namespace App\Controller;

use App\Entity\CoffeOrder;
use App\Entity\FlowerOrder;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderJsonController extends AbstractController
{
    /**
     * @var OrderService
     */
    private $OrderService;


    public function __construct(OrderService $order_service)
    {
        $this->OrderService = $order_service;
    }

    /**
     * @return JsonResponse
     * @Route("/json", name="json", methods={"GET"})
     */
    public function Action(): JsonResponse
    {

        $orders = $this->OrderService->OrderInJson();

        return new JsonResponse($orders, Response::HTTP_OK);
    }
}