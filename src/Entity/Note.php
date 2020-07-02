<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "You must be between {{ min }} and {{ max }} tall to enter",
     * )
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La matière est obligatoire")
     */
    private $matter;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="notes")
     * @Assert\NotBlank(message="L'étudiant est obligatoire")
     */
    private $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getMatter(): ?string
    {
        return $this->matter;
    }

    public function setMatter(string $matter): self
    {
        $this->matter = $matter;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
