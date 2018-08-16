<?php
namespace App\Service;


use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Entity\SideMenu;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserDataService
{
    private $em;
    private $session;

    public function __construct( EntityManagerInterface $entityManager, SessionInterface $session )
    {
        $this->em = $entityManager;
        $this->session = $session;
    }

    public function setCharacter( PlayerCharacter $character ) {
        $this->session->set('character', $character);
        $this->session->set('campaign', null);
        $this->session->set('type', 'player');
        $this->session->save();
    }

    public function getCharacter(): ?PlayerCharacter
    {
        if( $this->session->get('type') == 'player' ){
            // TODO : CLEAN : Mieux a faire pour contourner le lazy loader
            /** @var PlayerCharacter $character */
            $character = $this->em->getRepository( PlayerCharacter::class )->find( $this->session->get('character')->getId() );
            return $character;
        }
        return null;
    }

    public function setCampaign( Campaign $campaign ) {
        $this->session->set('campaign', $campaign);
        $this->session->set('character', null);
        $this->session->set('type', 'master');
        $this->session->save();
    }

    public function getCampaign(): ?Campaign
    {
        if( $this->session->get('type') == 'master' ){
            // TODO : CLEAN : Mieux a faire pour contourner le lazy loader
            /** @var Campaign $campaign */
            $campaign = $this->em->getRepository( Campaign::class )->find( $this->session->get('campaign')->getId() );
            return $campaign;
        }
        elseif ( $this->session->get('type') == 'player' ) {

            $character = $this->getCharacter();
            return $character->getCampaign();
        }
        return null;
    }

    public function getType(): ?string
    {
        return $this->session->get('type');
    }

    public function isMaster() {
        return $this->session->get('type') == 'master';
    }

    public function isPlayer() {
        return $this->session->get('type') == 'player';
    }

    public function clear() {
        $this->session->set('character', null);
        $this->session->set('campaign', null);
        $this->session->set('type', null);
    }

    /**
     * @return ArrayCollection|SideMenu[]|null
     */
    public function getMenu() {
        switch ( $this->session->get('type' )){
            case 'player' :
                return $this->getPlayerMenu();
            case 'master' :
                return $this->getMasterMenu();
            default :
                return null;
        }
    }

    /**
     * @return ArrayCollection|SideMenu[]
     */
    public function getPlayerMenu() {
        return $this->em->getRepository( SideMenu::class )->findBy( ['player' => true ] );
    }

    /**
     * @return ArrayCollection|SideMenu[]
     */
    public function getMasterMenu() {
        return $this->em->getRepository( SideMenu::class )->findBy( ['master' => true ] );
    }
}