<?php

namespace App\Form\Entities;

use App\Entity\PlayerCharacter;
use App\Entity\Report;
use App\Form\Rights\RightsType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Report $report */
        $report = $options['data'];

        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('dateGame', DateType::class, [
                'label' => 'Date',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Texte',
            ]);

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
            'data_class' => Report::class,
        ]);
    }
}
