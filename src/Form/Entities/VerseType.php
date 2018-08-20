<?php

namespace App\Form\Entities;

use App\Entity\Adam;
use App\Entity\PlayerCharacter;
use App\Entity\Verse;
use App\Form\Rights\RightsType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VerseType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Verse $verse */
        $verse = $options['data'];

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('quote', TextareaType::class, [
                'label' => 'Citation',
            ])
            ->add('karma', CheckboxType::class, [
                'label' => 'Karma',
            ])
            ->add('duration', TextType::class, [
                'label' => 'Durée',
            ])
            ->add('verseRange', TextType::class, [
                'label' => 'Portée',
            ])
            ->add('area', TextType::class, [
                'label' => 'Zone d\'effet',
            ])
            ->add('stackable', ChoiceType::class, [
                'label' => 'Cumul',
                'choices' => [
                    'oui' => true,
                    'non' => false,
                    '-' => null,
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])

            ->add('adam', EntityType::class, [
                'class' => Adam::class,
                'label' => 'Adam',
            ])
        ;

        parent::buildForm($builder, $options);

        $builder
            ->add( 'save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Verse::class,
        ]);
    }
}
