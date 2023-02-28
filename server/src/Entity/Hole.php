<?php

namespace App\Entity;

use App\Repository\HoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoleRepository::class)]
class Hole
{


    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $hole_id = null;

    #[ORM\Column]
    private ?int $par = null;

    #[ORM\Column]
    private ?float $parked_rate = null;

    #[ORM\Column]
    private ?float $c1_rate = null;

    #[ORM\Column]
    private ?float $c2_rate = null;

    #[ORM\Column]
    private ?float $scramble_rate = null;

    #[ORM\ManyToOne(targetEntity: 'app\entity\Course', inversedBy: 'hole_id')]
    #[ORM\JoinColumn(name: 'course_id', referencedColumnName: 'course_id')]
    private ?Course $course = null;

    #[ORM\OneToMany(mappedBy: 'hole', targetEntity: HoleResult::class)]
    #[ORM\JoinColumn(name: "hole_result_id", referencedColumnName: "hole_result_id")]
    private Collection $holeResults;


    public function __construct(?int $par, ?float $parked_rate, ?float $c1_rate, ?float $c2_rate, ?float $scramble_rate, ?course $course)
    {
        $this->par = $par;
        $this->parked_rate = $parked_rate;
        $this->c1_rate = $c1_rate;
        $this->c2_rate = $c2_rate;
        $this->scramble_rate = $scramble_rate;
        $this->course = $course;
        $this->holeResults = new ArrayCollection();
    }

    public function getHoleId(): ?int
    {
        return $this->hole_id;
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

    public function getScrambleRate(): ?float
    {
        return $this->scramble_rate;
    }

    public function setScrambleRate(float $scramble_rate): self
    {
        $this->scramble_rate = $scramble_rate;

        return $this;
    }

    public function getCourse(): ?course
    {
        return $this->course;
    }

    public function setCourse(?course $course): self
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, HoleResult>
     */
    public function getHoleResults(): Collection
    {
        return $this->holeResults;
    }

    public function addHoleResult(HoleResult $holeResult): self
    {
        if (!$this->holeResults->contains($holeResult)) {
            $this->holeResults->add($holeResult);
            $holeResult->setHole($this);
        }

        return $this;
    }

    public function removeHoleResult(HoleResult $holeResult): self
    {
        if ($this->holeResults->removeElement($holeResult)) {
            // set the owning side to null (unless already changed)
            if ($holeResult->getHole() === $this) {
                $holeResult->setHole(null);
            }
        }

        return $this;
    }

}
