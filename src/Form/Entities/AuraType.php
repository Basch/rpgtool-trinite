<?php

namespace App\Form\Entities;

use App\Entity\Aura;
use App\Entity\Zodiac;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuraType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Aura $aura */
        $aura = $options['data'];

        $builder
            ->add('sign', EntityType::class, [
                'class' => Zodiac::class,
                'label' => 'Signe',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('breath', TextareaType::class, [
                'label' => 'Souffle',
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
            'data_class' => Aura::class,
        ]);
    }
}
