<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class Signin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'required' => true,
            ])
            ->add('num', TelType::class, [
                'label' => 'Numéro de téléphone :',
                'required' => true,
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Adresse email :',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
            ]);
    }
}
