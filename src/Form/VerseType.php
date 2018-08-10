<?php

namespace App\Form;

use App\Entity\Adam;
use App\Entity\PlayerCharacter;
use App\Entity\Verse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VerseType extends MainType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Verse $verse */
        $verse = $options['data'];

        $campaign = $this->userData->getCampaign();

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

            ->add('owners', EntityType::class, [
                'label' => 'Possédé par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filter->getOwners( $verse ),
                'attr' => [
                    'data-select' => 'select2',
                ]
            ])
            ->add('viewers', EntityType::class, [
                'label' => 'Visible par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filter->getViewers( $verse ),
                'attr' => [
                    'data-select' => 'select2',
                ]
            ])
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
