<?php

namespace App\Entity;

use App\Repository\DefaultRewardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefaultRewardRepository::class)
 */
class DefaultReward
{
    public const FRENCH_REMOTE_CURRICULUM = 'frRem';
    public const FRENCH_REGULAR_CURRICULUM = 'frReg';
    public const EUROPEAN_REMOTE_CURRICULUM = 'eurRem';
    public const EUROPEAN_REGULAR_CURRICULUM = 'eurReg';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Reward::class)
     */
    private $rewards;

    public function __construct()
    {
        $this->rewards = new ArrayCollection();
    }

    public function __clone()
    {
        dd('ok');
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Reward[]
     */
    public function getRewards(): Collection
    {
        return $this->rewards;
    }

    public function addReward(Reward $reward): self
    {
            $this->rewards[] = $reward;

        return $this;
    }

    public function removeReward(Reward $reward): self
    {
        $this->rewards->removeElement($reward);

        return $this;
    }
    public function removeAllRewards(): self
    {
        $this->rewards = [];

        return $this;
    }
}
