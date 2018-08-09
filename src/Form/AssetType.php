<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\FireBlade;
use App\Entity\PlayerCharacter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends MainType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Asset $asset */
        $asset = $options['data'];

        $campaign = $this->userData->getCampaign();

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
            ])
            ->add('owners', EntityType::class, [
                'label' => 'Possédé par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filter->getOwners( $asset ),
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
                'data' => $this->filter->getViewers( $asset ),
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
            'data_class' => Asset::class,
        ]);
    }
}
