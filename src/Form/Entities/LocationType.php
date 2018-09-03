<?php

namespace App\Form\Entities;

use App\Entity\Asset;
use App\Entity\Location;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Asset $asset */
        $asset = $options['data'];

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
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
            'data_class' => Location::class,
        ]);
    }
}
