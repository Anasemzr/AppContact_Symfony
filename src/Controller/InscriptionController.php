<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(UtilisateurRepository $utilisateurRepository,Request $request)
    {
        $msg="";

        if ($request->isMethod('POST')) {
            // Récupération des données du formulaire
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $num = $request->request->get('num');
            $mail = $request->request->get('mail');

            // Création d'un nouvel utilisateur avec les données du formulaire
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setNum($num);
            $utilisateur->setEmail($mail);

            
            try {
                // Sauvegarde de l'utilisateur en base de données
                $utilisateurRepository->save($utilisateur);

                $msg = 'Inscription réussie.';
                return $this->redirectToRoute('ident');
            } catch (\Exception $e) {
                $msg = "Échec de l'inscription.";
            }

        }
        
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            'msg'=>$msg
        ]);
        

        
    }
}
