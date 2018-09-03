<?php

namespace App\Service;


use App\Entity\Comment;
use App\Model\FiltrableItemInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{

    private $em;
    private $parser;
    private $userData;

    public function __construct( ClassParserService $parser, UserDataService $userData, EntityManagerInterface $entityManager )
    {
        $this->em = $entityManager;
        $this->parser = $parser;
        $this->userData = $userData;
    }

    /**
     * @return ArrayCollection|Comment[]
     */
    public function getFromItem( FiltrableItemInterface $item ): Collection
    {
        if( !$item::COMMENTABLE ) return new ArrayCollection();

        $list = $this->em->getRepository( Comment::class )->findBy( [
            'item_type' => $this->parser->getClass( $item ),
            'item_id' => $item->getId(),
        ] );

        return new ArrayCollection( $list );
    }
}