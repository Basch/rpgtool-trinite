<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuraRepository")
 */
class Aura extends FiltrableItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Zodiac")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sign;

    public function getName()
    {
        return $this->getSign() ? $this->getSign()->getName() : "";
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug( string $slug ): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSign(): ?Zodiac
    {
        return $this->sign;
    }

    public function setSign(?Zodiac $sign): self
    {
        $this->sign = $sign;

        return $this;
    }



}
