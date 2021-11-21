<?php

namespace App\Entity;

use App\Repository\RewardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RewardRepository::class)
 */
class Reward
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGood = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRemoteFriendly = true;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $scheduledAt;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, mappedBy="rewards")
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity=Instructor::class, mappedBy="rewards")
     */
    private $instructors;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFrench = true;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->instructors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIsGood(): ?bool
    {
        return $this->isGood;
    }

    public function setIsGood(bool $isGood): self
    {
        $this->isGood = $isGood;

        return $this;
    }

    public function getIsRemoteFriendly(): ?bool
    {
        return $this->isRemoteFriendly;
    }

    public function setIsRemoteFriendly(bool $isRemoteFriendly): self
    {
        $this->isRemoteFriendly = $isRemoteFriendly;

        return $this;
    }

    public function getScheduledAt(): ?\DateTimeInterface
    {
        return $this->scheduledAt;
    }

    public function setScheduledAt(?\DateTimeInterface $scheduledAt): self
    {
        $this->scheduledAt = $scheduledAt;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->addReward($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            $student->removeReward($this);
        }

        return $this;
    }

    /**
     * @return Collection|Instructor[]
     */
    public function getInstructors(): Collection
    {
        return $this->instructors;
    }

    public function addInstructor(Instructor $instructor): self
    {
        if (!$this->instructors->contains($instructor)) {
            $this->instructors[] = $instructor;
            $instructor->addReward($this);
        }

        return $this;
    }

    public function removeInstructor(Instructor $instructor): self
    {
        if ($this->instructors->removeElement($instructor)) {
            $instructor->removeReward($this);
        }

        return $this;
    }

    public function getIsFrench(): ?bool
    {
        return $this->isFrench;
    }

    public function setIsFrench(bool $isFrench): self
    {
        $this->isFrench = $isFrench;

        return $this;
    }
}
