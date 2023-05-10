<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Repository\UtilisateurRepository;
use App\Repository\ContactRepository;


class ContactsController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function listContacts(Request $request, UtilisateurRepository $utilisateurRepository, ContactRepository $contactRepository)
    {
        // Vérification si l'utilisateur existe
        if ($request->isMethod('POST')) {
            $nom = $request->request->get('nom');
            $num = $request->request->get('num');
        }
        else{
            $nom = $request->query->get('nom');
            $num = $request->query->get('num');
        }
        
        $user = $utilisateurRepository->findOneBy(['nom' => $nom, 'num' => $num]);
        if (!$user) {
            return $this->render('identification/index.html.twig');
        }

        $contacts = $contactRepository->findBy(['id_contact' => $user->getIdNom()]);
        
        $utilisateurs = [];
        
        foreach ($contacts as $contact) {
            $utilisateur = $utilisateurRepository->findOneBy(['id_nom' => $contact->getid_nom()]);
            $utilisateurs[] = [
                'prenom' => $utilisateur->getPrenom(),
                'nom' => $utilisateur->getNom(),
                'email' => $utilisateur->getEmail(),
            ];
        }
        
        //on affiche
        return $this->render('contacts/index.html.twig', [
            'contacts' => $utilisateurs,
            'nom' => $nom,
            'userID' => $user->getIdNom(),
            'numID' => $user->getNum(),
            'nomID' => $nom
        ]);
    }



    #[Route('/contacts_add', name: 'app_addcontacts')]
    public function addContacts(Request $request,ContactRepository $contactRepository, UtilisateurRepository $utilisateurRepository)
    {
        if ($request->isMethod('POST')) {
            $nomID = $request->request->get('nomID');
            $numID = $request->request->get('numID');

            $userID = $request->request->get('userID');

            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            
            $newcontact = $utilisateurRepository->findOneBy(['nom' => $nom, 'prenom' => $prenom]);

            if ($newcontact) {
                $existecontact = $contactRepository->findOneBy(['id_nom' => $userID, 'id_contact' => $newcontact->getIdNom()]);
                if (!$existecontact){
                    
                    $contactRepository->save($userID,$newcontact->getIdNom());
                    $contactRepository->save($newcontact->getIdNom(),$userID,);
    
                }
                
            }
        }

        return $this->redirectToRoute('contacts', ['nom'=>$nomID,'num'=>$numID]);
    }

    #[Route('/contacts_supp', name: 'app_suppcontacts')]
    public function suppContacts(Request $request,ContactRepository $contactRepository, UtilisateurRepository $utilisateurRepository)
    {
        if ($request->isMethod('POST')) {
            $nomID = $request->request->get('nomID');
            $numID = $request->request->get('numID');

            $userID = $request->request->get('userID');

            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            
            $oldcontact = $utilisateurRepository->findOneBy(['nom' => $nom, 'prenom' => $prenom]);

            if ($oldcontact) {
                $existecontact = $contactRepository->findOneBy(['id_nom' => $userID, 'id_contact' => $oldcontact->getIdNom()]);
                if ($existecontact){
                    
                    $contactRepository->remove($userID,$oldcontact->getIdNom());

                    $contactRepository->remove($oldcontact->getIdNom(),$userID);
                    
                }
                
            }
        }

        return $this->redirectToRoute('contacts', ['nom'=>$nomID,'num'=>$numID]);
    }
}

