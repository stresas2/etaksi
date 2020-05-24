<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class OrderJsonController
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
     * @Route("/json", name="json")
     */
    public function Action(): JsonResponse
    {

        $orders = $this->OrderService->OrderInJson();

        return new JsonResponse($orders, Response::HTTP_OK);
    }
}