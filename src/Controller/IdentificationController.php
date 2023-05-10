<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Service\IdentificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Login;

class IdentificationController extends AbstractController
{
    #[Route('/ident', name: 'ident')]
    public function index(Request $request): Response
    {
        return $this->render('identification/index.html.twig');
    }
}