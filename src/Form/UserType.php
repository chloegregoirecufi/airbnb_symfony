<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'required' => true,
                'constraints' => [ 
                    new NotBlank([
                        'message' => ' L\'email {{ value }} n\'est pas valide '
                    ])
                ]
            ])
            ->add('password', PasswordType::class, [
                // 'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre mode de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe à un minimum de {{ limit }} characteres attendus',
                        'max' => 4096,
                    ]),
                ],
            ])            
            ->add('firstname', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prénom doit être renseigné'
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom doit être renseigné'
                    ])
                ]
                ])
            ->add('phone',TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le numéro de téléphone doit être renseigné'
                    ])
                ]
                ])
            ->add('address', TextType::class, [
                'required' => true, 
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse doit être renseigné'
                    ])
                ]
                ])
            ->add('city', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'La ville doit être renseigné'
                    ])
                ]
                ])
            ->add('codepostale', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le code postale doit être renseigné'
                    ])
                ]
                    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
