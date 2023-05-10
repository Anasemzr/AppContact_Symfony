<?php

//src/Entity/Contact.php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * 
     * @ORM\Column(type="integer")
     */
    private $id_nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_contact;

    public function getid_nom(): ?int
    {
        return $this->id_nom;
    }

    public function setIdNom(int $id_nom): self
    {
        $this->id_nom = $id_nom;

        return $this;
    }

    public function getid_contact(): ?int
    {
        return $this->id_contact;
    }

    public function setIdContact(int $id_contact): self
    {
        $this->id_contact = $id_contact;

        return $this;
    }
}
