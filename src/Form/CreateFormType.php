<?php

namespace App\Form;

use App\Entity\Posts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('create_at')
            ->add('title', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom de jeu vidéo please',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('subtitle', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez ajouter un titre à votre review',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le titre doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('content', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le contenu de votre review est vide !',
                    ]),
                ]
            ])
            ->add('author');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
