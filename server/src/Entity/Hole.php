<?php

namespace App\Entity;

use App\Repository\HoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoleRepository::class)]
class Hole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $par = null;

    #[ORM\Column]
    private ?float $parked_rate = null;

    #[ORM\Column]
    private ?float $c1_rate = null;

    #[ORM\Column]
    private ?float $c2_rate = null;

    #[ORM\Column]
    private ?float $scarmble_rate = null;

    #[ORM\ManyToOne(inversedBy: 'holes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?course $course_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPar(): ?int
    {
        return $this->par;
    }

    public function setPar(int $par): self
    {
        $this->par = $par;

        return $this;
    }

    public function getParkedRate(): ?float
    {
        return $this->parked_rate;
    }

    public function setParkedRate(float $parked_rate): self
    {
        $this->parked_rate = $parked_rate;

        return $this;
    }

    public function getC1Rate(): ?float
    {
        return $this->c1_rate;
    }

    public function setC1Rate(float $c1_rate): self
    {
        $this->c1_rate = $c1_rate;

        return $this;
    }

    public function getC2Rate(): ?float
    {
        return $this->c2_rate;
    }

    public function setC2Rate(float $c2_rate): self
    {
        $this->c2_rate = $c2_rate;

        return $this;
    }

    public function getScarmbleRate(): ?float
    {
        return $this->scarmble_rate;
    }

    public function setScarmbleRate(float $scarmble_rate): self
    {
        $this->scarmble_rate = $scarmble_rate;

        return $this;
    }

    public function getCourseId(): ?course
    {
        return $this->course_id;
    }

    public function setCourseId(?course $course_id): self
    {
        $this->course_id = $course_id;

        return $this;
    }
}
