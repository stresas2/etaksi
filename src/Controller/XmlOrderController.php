<?php


namespace App\Controller;

use App\Service\OrderService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class XmlOrderController
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
     * @Route("/xml", name="xml", defaults={"_format"="xml"}, methods={"GET"})
     */
    public function action(){
        $orders = $this->OrderService->OrderInXml();
        $response = new Response($orders);
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }

}