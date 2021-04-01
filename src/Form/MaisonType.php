<?php

namespace App\Form;

use App\Entity\Maison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'required'=>true,
                'label'=>'Titre',
                'attr'=> [
                    'placeholder'=>'EX:maison de campagne '
                ]
            ])
            ->add('description',TextType::class,[
                'required'=>true,
                'label'=>'description',
                'attr'=> [
                    'placeholder'=>'EX: jolie maison de campagne au bord de la riviere  '
                ]
            ])
            ->add('rooms' ,IntegerType::class,[
                'required'=>true,
                'label'=>'pieces',
                'attr'=> [
                    'placeholder'=>' Ex:4'
                ]
            ])
            ->add('bedrooms',IntegerType::class,[
                'required'=>true,
                'label'=>'chambres',
                'attr'=> [
                    'placeholder'=>'le nombre de chambre',
                    'min'=> 0 
                ]
            ])
            ->add('price',MoneyType::class,[
                'required'=>true,
                'label'=>'prix',
                'attr'=> [
                    'placeholder'=>'EX:208000 ',
                    'min'=> 0 
                ]
            ])
            
            ->add('surface',IntegerType::class,[
                'required'=>true,
                'label'=>'superficie (m2)',
                'attr'=> [
                    'placeholder'=>'EX:130',
                    'min' => 30 
                ]
            ])
            ->add('img1',FileType::class,[
                'required'=>true,
                'mapped'=>false,
                'label'=>'image 1',
                'attr'=> [
                    'placeholder'=>'l\'images principal maison dans sont esemble',
                ],
                'help' => 'png, jpg ou jpeg - 1 Mo maximum'
            ])
            ->add('img2',FileType::class,[
                'required'=>false,
                'mapped'=>false,
                'label'=>'image 2',
                'attr'=> [
                    'placeholder'=>'l\'images des pieces',
                ]
            ])
            ->add('img3',FileType::class,[
                'required'=>false,
                'mapped'=>false,
                'label'=>'image 3',
                'attr'=> [
                    'placeholder'=>'l\'images des pieces',
                ]
            ])
            ->add('valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Maison::class,
        ]);
    }
}
