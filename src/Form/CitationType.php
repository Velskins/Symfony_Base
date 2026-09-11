<?php

namespace App\Form;

use App\Entity\Citation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte', TextareaType::class, [
                'label' => 'Texte de la citation',
                'attr' => ['rows' => 4],
            ])
            ->add('auteur', TextType::class, [
                'label' => 'Auteur',
            ])
            ->add('source', TextType::class, [
                'label' => 'Source / origine',
                'required' => false,
                'help' => 'Livre, film, discours… (facultatif)',
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Philosophie' => 'philosophie',
                    'Humour' => 'humour',
                    'Science' => 'science',
                    'Cinéma' => 'cinema',
                    'Littérature' => 'litterature',
                    'Autre' => 'autre',
                ],
            ])
            ->add('langue', ChoiceType::class, [
                'label' => 'Langue',
                'choices' => [
                    'Français' => 'fr',
                    'Anglais' => 'en',
                    'Autre' => 'autre',
                ],
            ])
            ->add('note', IntegerType::class, [
                'label' => 'Note (1 à 5)',
                'required' => false,
            ])
            ->add('favori', CheckboxType::class, [
                'label' => 'Ajouter aux favoris',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Citation::class,
        ]);
    }
}