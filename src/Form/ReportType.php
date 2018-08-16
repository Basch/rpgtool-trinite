<?php

namespace App\Form;

use App\Entity\PlayerCharacter;
use App\Entity\Report;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends MainType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Report $report */
        $report = $options['data'];

        $campaign = $this->userData->getCampaign();

        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('dateGame', DateType::class, [
                'label' => 'Citation',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Karma',
            ])
            ->add('viewers', EntityType::class, [
                'label' => 'Visible par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filterPlayer->getViewers( $report ),
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
            'data_class' => Report::class,
        ]);
    }
}
