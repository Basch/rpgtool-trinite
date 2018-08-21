<?php

namespace App\Form\Entities;

use App\Entity\Asset;
use App\Entity\FireBlade;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Asset $asset */
        $asset = $options['data'];

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('color', TextType::class, [
                'label' => 'Couleur',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('fireBlade', EntityType::class, [
                'class' => FireBlade::class,
                'label' => 'Epée de feu',
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
            'data_class' => Asset::class,
        ]);
    }
}
