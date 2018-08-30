<?php

namespace App\Model;


use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Entity\User;

interface FiltrableItemInterface
{

    public const USER_CREATABLE = false;
    public const CAMPAIGN_RELATED = false;
    public const BE_OWNED = true;

    public function getId();
    public function getSlug();
    public function getName();

    public function getCreator(): ?User;
    public function setCreator(?User $creator);

    public function getWriter(): ?PlayerCharacter;
    public function setWriter(?PlayerCharacter $writer);

    public function getCampaign(): ?Campaign;
    public function setCampaign(?Campaign $campaign);


}