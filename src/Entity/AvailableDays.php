<?php

namespace App\Entity;

use App\Repository\AvailableDaysRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailableDaysRepository::class)
 */
class AvailableDays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $dateset = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateset(): ?array
    {
        return $this->dateset;
    }

    public function setDateset(array $dateset): self
    {
        $this->dateset = $dateset;

        return $this;
    }
}
