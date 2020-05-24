<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XmlOrderController extends AbstractController
{
    /**
     * @Route("/xml", name="xml", methods={"GET"})
     */
    public function Action(){
        $xml = '<?xml version="1.0" encoding="UTF-8"?> <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $xml .= '<mynode><content>Hello</content></mynode>';

        $response = new Response($xml);
        $response->headers->set('Content-Type', 'xml');

        return $response;
    }

}