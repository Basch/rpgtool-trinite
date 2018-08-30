<?php

namespace App\Form\Entities;

use App\Entity\PlayerCharacter;
use App\Model\FiltrableItemInterface;
use App\Service\FilterService;
use App\Service\UserDataService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class GenericType extends AbstractType
{
    protected $userData;
    protected $filter;

    public function __construct( UserDataService $userData, FilterService $filter)
    {
        $this->userData = $userData;
        $this->filter = $filter;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var FiltrableItemInterface $item */
        $item = $options['data'];

        $campaign = $this->userData->getCampaign();
        $choices = clone $campaign->getCharacters();

        if( $item->getWriter() === $this->userData->getCharacter() ){
            $choices->removeElement( $item->getWriter() );
        }

        if( $item::BE_OWNED ) {
            $builder
                ->add('owners', EntityType::class, [
                    'label' => 'Possédé par',
                    'class' => PlayerCharacter::class,
                    'choices' => $choices,
                    'mapped' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false,
                    'data' => $this->filter->getOwners($item),
                ]);
        }

        $builder
            ->add('viewers', EntityType::class, [
                'label' => 'Visible par',
                'class' => PlayerCharacter::class,
                'choices' => $choices,
                'mapped' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'data' => $this->filter->getViewers( $item ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FiltrableItemInterface::class,
        ]);
    }

}
