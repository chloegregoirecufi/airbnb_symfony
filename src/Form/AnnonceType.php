<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Annonce;
use App\Entity\Equipement;
use App\Entity\TypeDeBien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address')
            ->add('price')
            ->add('size')
            ->add('description')
            ->add('couchage')
            ->add('imageFile', FileType::class, [
                'label' => 'Choisir un ficher(JPEG, PNG, JPG, WEBP)',
                'required' => false,
                'attr' => ['class' => 'form-control mb-3'],
                'constraints' => [
                    new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/jpg',
                        'image/webp'
                    ],
                ])
            ]
            ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
              //champ pour récupérer les équipements
            ->add('equipements', EntityType::class, [
            'label' => 'equipement: ',
            'class' => Equipement::class,
            'choice_label' => 'label',
            'attr' => ['class' => 'form-control mb-3 form-check form-switch'],
            'multiple' => true,
            'expanded' => true
            ])
            ->add('typeBien', EntityType::class, [
                'class' => TypeDeBien::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
