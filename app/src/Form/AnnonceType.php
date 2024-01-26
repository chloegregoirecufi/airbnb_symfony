<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Equipement;
use App\Entity\Image;
use App\Entity\TypeDeBien;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('image', EntityType::class, [
                'class' => Image::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
'choice_label' => 'id',
'multiple' => true,
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
