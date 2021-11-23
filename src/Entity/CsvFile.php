<?php

namespace App\Entity;

use App\Repository\CsvFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=CsvFileRepository::class)
 * @Vich\Uploadable
 */
class CsvFile implements \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $csv;

    /**
     * @Assert\File(
     *     maxSize = "1000k",

     *     mimeTypesMessage = "Please upload a valid csv"
     * )
     * @Vich\UploadableField(mapping="user_csv", fileNameProperty="csv")
     * @var File
     */
    private $csvFile;

    /**

     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCsv(): ?string
    {
        return $this->csv;
    }

    /**
     * @param mixed $csv
     */
    public function setCsv(?string $csv): self
    {
        $this->csv = $csv;
        return $this;
    }

    /**
     * @return File
     */
    public function getCsvFile(): ?File
    {
        return $this->csvFile;
    }

    /**
     * @param File $csvFile
     */
    public function setCsvFile(File $csv = null)
    {
        $this->csvFile = $csv;
        if ($csv) {
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;

    }



    public function serialize()
    {
        $this->csvFile = base64_encode($this->csvFile);
    }

    public function unserialize($data)
    {
        $this->csvFile = base64_decode($this->csvFile);
    }


}
