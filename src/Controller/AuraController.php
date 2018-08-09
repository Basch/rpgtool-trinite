<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Aura;
use App\Form\AssetType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Tests\Normalizer\DataUriNormalizerTest;

class AuraController extends MainController
{

    /**
     * @Route("/aura", name="aura")
     */
    public function main() {
        if( $error = $this->control() ) { return $error; }

        return $this->list();
    }

    /**
     * @Route("/aura/liste", name="aura.list")
     */
    public function list()
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){
            return $this->listMaster();
        }
        else {
            return $this->listPlayer();
        }
    }

    /**
     * @Route("joueur/aura/liste", name="player.aura.list")
     */
    public function listPlayer()
    {
        if( $error = $this->controlPlayer() ) { return $error; }

        $assets = $this->userData->getCharacter()->getVisibleAssets();


        return $this->render('pages/aura/list.player.html.twig', [
            'assets' => $assets,
        ]);
    }

    /**
     * @Route("meneur/aura/liste", name="master.aura.list")
     */
    public function listMaster()
    {
        if( $error = $this->controlMaster() ) { return $error; }

            $assets = $this->getDoctrine()->getRepository( Asset::class )->findAll();

        return $this->render('pages/aura/list.master.html.twig', [
            'assets' => $assets,
        ]);
    }


    /**
     * @Route("/aura/{auraSlug}", name="aura.show")
     * @ParamConverter("aura", options={"mapping"={"auraSlug"="slug"}})
     */
    public function show( Aura $aura, Request $request )
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){
            return $this->showMaster( $aura, $request );
        }
        else {
            return $this->showPlayer( $aura );
        }
    }

    /**
     * @Route("joueur/aura/{auraSlug}", name="player.aura.show")
     * @ParamConverter("aura", options={"mapping"={"auraSlug"="slug"}})
     */
    public function showPlayer( Aura $aura )
    {
        if( $error = $this->controlPlayer() ) { return $error; }

        $character = $this->userData->getCharacter();

        if( !$character->getVisibleAssets()->contains( $aura ) ) {
            $this->addFlash(
                'warning',
                'Votre personnage ne peut pas voir cet atout.'
            );
            return $this->redirectToRoute('asset.list');
        }

        return $this->render('pages/asset/show.player.html.twig', [
            'asset' => $aura,
        ]);

    }

    /**
     * @Route("maitre/aura/{auraSlug}", name="master.aura.show")
     * @ParamConverter("aura", options={"mapping"={"auraSlug"="slug"}})
     */
    public function showMaster( Aura $aura, Request $request )
    {
        if( $error = $this->controlMaster() ) { return $error; }

        $em = $this->getDoctrine()->getManager();

        /** @var Aura $bdd_aura */
        $bdd_aura = $em->getRepository( Aura::class )->find( $aura->getId() );
        $bdd_characters = new ArrayCollection();
        if( $bdd_aura ){
            $bdd_characters = clone $bdd_aura->getFilterCharacters();
        }

        $original_characters = clone $aura->getCharacters();
        $original_filters = clone $aura->getFilterCharacters();

        $form = $this->createForm( AssetType::class, $aura );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {


            $campaign = $this->userData->getCampaign();

            foreach( $original_characters as $character ) if ( $character->getCampaign()->getId() == $campaign->getId() ){
                $character->removeAura( $aura );
            }
            foreach( $aura->getCharacters() as $character ){
                $character->addAura( $aura );
            }

            foreach( $original_filters as $character ) if ( $character->getCampaign()->getId() == $campaign->getId() ){
                $bdd_characters->removeElement( $character );
            }
            foreach( $aura->getFilterCharacters() as $character ){
                $bdd_characters->add( $character );
            }

            $aura->copyFilterCharacter( $bdd_characters );

            $em->persist( $aura );
            $em->flush();


            return $this->redirectToRoute('master.asset.show', [
                'assetSlug' => $aura->getSlug()
            ]);
        }

        return $this->render('pages/asset/show.master.html.twig', [
            'asset' => $aura,
            'form' => $form->createView(),
        ]);
    }
}
