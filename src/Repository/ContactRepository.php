<?php 

// src/Repository/ContactRepository.php

namespace App\Repository;

use App\Entity\Contact;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function save(Int $userID, Int $newUserID): void
    {
        $contact = new Contact();
        $contact->setIdNom($userID);
        $contact->setIdContact($newUserID);
        $this->_em->persist($contact);
        $this->_em->flush();
    }

    public function remove(Int $userID, Int $oldcontact)
    {
        
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->delete(Contact::class, 'c')
            ->where('c.id_nom = :id_nom')
            ->andWhere('c.id_contact = :id_contact')
            ->setParameter('id_nom', $userID)
            ->setParameter('id_contact', $oldcontact)
            ->getQuery()
            ->execute();
    }
}
