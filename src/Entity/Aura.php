<?php

namespace App\Entity;

use App\Model\FiltrableItemCharacterInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuraRepository")
 */
class Aura implements FiltrableItemCharacterInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $breath;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Zodiac", inversedBy="aura", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sign;

    /**
     * @Gedmo\Slug(handlers={
     *      @Gedmo\SlugHandler(class="Gedmo\Sluggable\Handler\RelativeSlugHandler", options={
     *          @Gedmo\SlugHandlerOption(name="relationField", value="sign"),
     *          @Gedmo\SlugHandlerOption(name="relationSlugField", value="slug"),
     *          @Gedmo\SlugHandlerOption(name="separator", value="")
     *      })
     * }, separator="-", updatable=true, fields={"id"}, prefix="aura-")
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="FilterCharacterAura", mappedBy="aura", orphanRemoval=true)
     */
    private $FilterCharacter;


    public function __construct()
    {
        $this->FilterCharacter = new ArrayCollection();
    }

    public function __toString()
    {
        return 'Aura : '.$this->getSign()->getName();
    }

    public function getId()
    {
        return $this->id;
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

    public function getBreath(): ?string
    {
        return $this->breath;
    }

    public function setBreath(string $breath): self
    {
        $this->breath = $breath;

        return $this;
    }

    public function getSign(): ?Zodiac
    {
        return $this->sign;
    }

    public function setSign(Zodiac $sign): self
    {
        $this->sign = $sign;

        return $this;
    }

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
     * @return Collection|FilterCharacterAura[]
     */
    public function getFilterCharacter(): Collection
    {
        return $this->FilterCharacter;
    }

    public function addFilterCharacter( FilterCharacterAura $filterCharacter): self
    {
        if (!$this->FilterCharacter->contains($filterCharacter)) {
            $this->FilterCharacter[] = $filterCharacter;
            $filterCharacter->setAura($this);
        }

        return $this;
    }

    public function removeFilterCharacter( FilterCharacterAura $filterCharacter): self
    {
        if ($this->FilterCharacter->contains($filterCharacter)) {
            $this->FilterCharacter->removeElement($filterCharacter);
            // set the owning side to null (unless already changed)
            if ($filterCharacter->getAura() === $this) {
                $filterCharacter->setAura(null);
            }
        }

        return $this;
    }

}
