<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends MainController
{

    /**
     * @Route("/atout", name="asset")
     */
    public function main() {
        if( $error = $this->control() ) { return $error; }

        return $this->list();
    }

    /**
     * @Route("/atout/liste", name="asset.list")
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
     * @Route("joueur/atout/liste", name="player.asset.list")
     */
    public function listPlayer()
    {
        if( $error = $this->controlPlayer() ) { return $error; }

        $assets = $this->filter->getVisibleItems( Asset::class, $this->userData->getCharacter() );

        return $this->render('pages/asset/list.player.html.twig', [
            'assets' => $assets,
        ]);
    }

    /**
     * @Route("meneur/atout/liste", name="master.asset.list")
     */
    public function listMaster()
    {
        if( $error = $this->controlMaster() ) { return $error; }

            $assets = $this->getDoctrine()->getRepository( Asset::class )->findAll();

        return $this->render('pages/asset/list.master.html.twig', [
            'assets' => $assets,
        ]);
    }


    /**
     * @Route("/atout/{assetSlug}", name="asset.show")
     * @ParamConverter("asset", options={"mapping"={"assetSlug"="slug"}})
     */
    public function show( Asset $asset, Request $request )
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){
            return $this->showMaster( $asset, $request );
        }
        else {
            return $this->showPlayer( $asset );
        }
    }

    /**
     * @Route("joueur/atout/{assetSlug}", name="player.asset.show")
     * @ParamConverter("asset", options={"mapping"={"assetSlug"="slug"}})
     */
    public function showPlayer( Asset $asset )
    {
        if( $error = $this->controlPlayer() ) { return $error; }

        if( !$this->filter->viewItem( $asset ) ) {
            $this->addFlash(
                'warning',
                'Votre personnage ne peut pas voir cet atout.'
            );
            return $this->redirectToRoute('asset.list');
        }

        return $this->render('pages/asset/show.player.html.twig', [
            'asset' => $asset,
        ]);

    }

    /**
     * @Route("maitre/atout/{assetSlug}", name="master.asset.show")
     * @ParamConverter("asset", options={"mapping"={"assetSlug"="slug"}})
     */
    public function showMaster( Asset $asset, Request $request )
    {
        if( $error = $this->controlMaster() ) { return $error; }

        $form = $this->createForm( AssetType::class, $asset );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            $data = $request->request->get('asset' );

            $this->filter->updateOwners( $asset, $data['owners'] ?? [] );
            $this->filter->updateViewers( $asset, $data['viewers'] ?? [] );

            $em->persist( $asset );
            $em->flush();

            return $this->redirectToRoute('master.asset.show', [
                'assetSlug' => $asset->getSlug()
            ]);
        }

        return $this->render('pages/asset/show.master.html.twig', [
            'asset' => $asset,
            'form' => $form->createView(),
        ]);
    }
}
