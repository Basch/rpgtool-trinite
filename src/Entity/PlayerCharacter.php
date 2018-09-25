<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerCharacterRepository")
 */
class PlayerCharacter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="characters", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSkill", mappedBy="character", orphanRemoval=true)
     */
    private $characterSkills;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", inversedBy="characters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campaign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="FilterCharacter", mappedBy="playerCharacter", orphanRemoval=true)
     */
    private $filters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="writer")
     */
    private $writedComments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zodiac")
     */
    private $archetype;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Zodiac")
     * @ORM\JoinTable(name="player_character_ascendant")
     */
    private $ascendants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Zodiac")
     * @ORM\JoinTable(name="player_character_descendant")
     */
    private $descendants;

    public function __construct()
    {
        $this->characterSkills = new ArrayCollection();
        $this->filters = new ArrayCollection();
        $this->writedComments = new ArrayCollection();
        $this->ascendants = new ArrayCollection();
        $this->descendants = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CharacterSkill[]
     */
    public function getCharacterSkills(): Collection
    {
        return $this->characterSkills;
    }

    public function addCharacterSkill(CharacterSkill $characterSkill): self
    {
        if (!$this->characterSkills->contains($characterSkill)) {
            $this->characterSkills[] = $characterSkill;
            $characterSkill->setCharacter($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getCharacter() === $this) {
                $characterSkill->setCharacter(null);
            }
        }

        return $this;
    }

    public function getCharacterSkill( Skill $skill ): CharacterSkill {
        return $this->getCharacterSkills()->filter( function( CharacterSkill $characterSkill ) use ( $skill ) {
           return $characterSkill->getSkill() === $skill;
        })->first();
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

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
     * @return Collection|FilterCharacter[]
     */
    public function getFilterReports(): Collection
    {
        return $this->filters;
    }

    public function addFilterReport( FilterCharacter $filter): self
    {
        if (!$this->filters->contains($filter)) {
            $this->filters[] = $filter;
            $filter->setPlayerCharacter($this);
        }

        return $this;
    }

    public function removeFilterReport( FilterCharacter $filter): self
    {
        if ($this->filters->contains($filter)) {
            $this->filters->removeElement($filter);
            // set the owning side to null (unless already changed)
            if ($filter->getPlayerCharacter() === $this) {
                $filter->setPlayerCharacter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getWritedComments(): Collection
    {
        return $this->writedComments;
    }

    public function addWritedComment(Comment $writedComment): self
    {
        if (!$this->writedComments->contains($writedComment)) {
            $this->writedComments[] = $writedComment;
            $writedComment->setWriter($this);
        }

        return $this;
    }

    public function removeWritedComment(Comment $writedComment): self
    {
        if ($this->writedComments->contains($writedComment)) {
            $this->writedComments->removeElement($writedComment);
            // set the owning side to null (unless already changed)
            if ($writedComment->getWriter() === $this) {
                $writedComment->setWriter(null);
            }
        }

        return $this;
    }

    public function getArchetype(): ?Zodiac
    {
        return $this->archetype;
    }

    public function setArchetype(?Zodiac $archetype): self
    {
        $this->archetype = $archetype;

        return $this;
    }

    /**
     * @return Collection|Zodiac[]
     */
    public function getAscendants(): Collection
    {
        return $this->ascendants;
    }

    public function addAscendant(Zodiac $ascendant): self
    {
        if (!$this->ascendants->contains($ascendant) && $this->ascendants->count() < 2 ) {
            $this->ascendants[] = $ascendant;
        }

        return $this;
    }

    public function removeAscendant(Zodiac $ascendant): self
    {
        if ($this->ascendants->contains($ascendant)) {
            $this->ascendants->removeElement($ascendant);
        }

        return $this;
    }

    /**
     * @return Collection|Zodiac[]
     */
    public function getDescendants(): Collection
    {
        return $this->descendants;
    }

    public function addDescendant(Zodiac $descendant): self
    {
        if (!$this->descendants->contains($descendant) && $this->descendants->count() < 3 ) {
            $this->descendants[] = $descendant;
        }

        return $this;
    }

    public function removeDescendant(Zodiac $descendant): self
    {
        if ($this->descendants->contains($descendant)) {
            $this->descendants->removeElement($descendant);
        }

        return $this;
    }

    /**
     * @return Collection|Zodiac[]
     */
    public function listZodiacs():Collection {
        $zodiacs = new ArrayCollection();
        $zodiacs->add( $this->getArchetype() );
        foreach ( $this->getAscendants() as $descendant ){
            $zodiacs->add( $descendant );
        }
        foreach ( $this->getDescendants() as $descendant ){
            $zodiacs->add( $descendant );
        }
        return $zodiacs;
    }

    public function getZodiacLevel( Zodiac $zodiac ): int {
        if( $this->archetype === $zodiac ) return 6;
        if( $this->ascendants->contains( $zodiac ) ) return 4;
        if( $this->descendants->contains( $zodiac) ) return 2;
        return 0;
    }

}
