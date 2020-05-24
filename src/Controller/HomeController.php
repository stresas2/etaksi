<?php

namespace App\Controller;

use App\Form\CoffeeFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\CoffeOrder;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/", name="home")
     * @throws \Exception
     */
    public function index(Request $request): Response
    {
        $coffee_form = $this->createForm(CoffeeFormType::class);
        $coffee_form->handleRequest($request);

        if ($coffee_form->isSubmitted() && $coffee_form->isValid()) {
            /** @var CoffeOrder $coffee_order */
            $coffee_order = $coffee_form->getData();
            $coffee_order->setCreatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffee_order);
            $entityManager->flush();
            $this->addFlash('success', 'Coffee successfully ordered!');
        }

        return $this->render('pages/home.html.twig', [
            'coffee_form' => $coffee_form->createView()
        ]);
    }

}
