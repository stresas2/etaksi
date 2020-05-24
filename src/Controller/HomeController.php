<?php

namespace App\Controller;

use App\Entity\FlowerOrder;
use App\Form\CoffeeFormType;
use App\Form\FlowerFormType;
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
        $flower_form = $this->createForm(FlowerFormType::class);
        $coffee_form->handleRequest($request);
        $flower_form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($coffee_form->isSubmitted() && $coffee_form->isValid()) {
            /** @var CoffeOrder $coffee_order */
            $coffee_order = $coffee_form->getData();
            $coffee_order->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($coffee_order);
            $entityManager->flush();
            $this->addFlash('success', 'Coffee successfully ordered!');
        }

        if ($flower_form->isSubmitted() && $flower_form->isValid()) {
            /** @var FlowerOrder $coffee_order */
            $flower_order = $flower_form->getData();
            $entityManager->persist($flower_order);
            $entityManager->flush();
            $this->addFlash('success', 'Flower successfully ordered!');
        }

        return $this->render('pages/home.html.twig', [
            'coffee_form' => $coffee_form->createView(),
            'flower_form' => $flower_form->createView()
        ]);
    }

}
