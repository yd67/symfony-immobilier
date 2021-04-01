<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'required' => true

            ])
            ->add('prenom',TextType::class,[
                'required' => true

            ])
            ->add('email',EmailType::class,[
                'required' => true

            ])
            ->add('objet',ChoiceType::class,[
                'required' => true,
                'choices' => [
                    'choix' => '',
                    'demande de devis' =>'devis',
                    'visiter un logement' => 'visite',
                    'signaler un problem' => 'problem'
                ]

            ])
            ->add('message',TextareaType::class,[
                 'attr' =>[
                     'min' => 30 ,
                     'maxlength' => 1000
                 ],
                

            ])
            ->add('valider',SubmitType::class,[

            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
