<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NonPlayerCharacterRepository")
 */
class NonPlayerCharacter extends FiltrableItem
{
    public const USER_CREATABLE = false;
    public const BE_OWNED = false;
    public const CAMPAIGN_RELATED = true;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NonPlayerCharacterSkill", mappedBy="npc", orphanRemoval=true)
     */
    private $nonPlayerCharacterSkills;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug( string $slug ): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->nonPlayerCharacterSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|NonPlayerCharacterSkill[]
     */
    public function getNonPlayerCharacterSkills(): Collection
    {
        return $this->nonPlayerCharacterSkills;
    }

    public function addNonPlayerCharacterSkill(NonPlayerCharacterSkill $nonPlayerCharacterSkill): self
    {
        if (!$this->nonPlayerCharacterSkills->contains($nonPlayerCharacterSkill)) {
            $this->nonPlayerCharacterSkills[] = $nonPlayerCharacterSkill;
            $nonPlayerCharacterSkill->setNpc($this);
        }

        return $this;
    }

    public function removeNonPlayerCharacterSkill(NonPlayerCharacterSkill $nonPlayerCharacterSkill): self
    {
        if ($this->nonPlayerCharacterSkills->contains($nonPlayerCharacterSkill)) {
            $this->nonPlayerCharacterSkills->removeElement($nonPlayerCharacterSkill);
            // set the owning side to null (unless already changed)
            if ($nonPlayerCharacterSkill->getNpc() === $this) {
                $nonPlayerCharacterSkill->setNpc(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
