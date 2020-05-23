<?php

namespace App\Controller;

use App\Entity\Student;
use App\Service\StudentService;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarksController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }
    
}