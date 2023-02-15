<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ORM\Table('Course')]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $course_id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $course_par = null;

    #[ORM\OneToMany(mappedBy: 'course_id', targetEntity: Hole::class)]
    private Collection $holes;

    #[ORM\OneToMany(mappedBy: 'course_id', targetEntity: Tournament::class)]
    private Collection $tournaments;

    public function __construct()
    {
        $this->holes = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
    }

    public function getCourseId(): ?int
    {
        return $this->course_id;
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

    public function getCoursePar(): ?int
    {
        return $this->course_par;
    }

    public function setCoursePar(int $course_par): self
    {
        $this->course_par = $course_par;

        return $this;
    }

    /**
     * @return Collection<int, Hole>
     */
    public function getHoles(): Collection
    {
        return $this->holes;
    }

    public function addHole(Hole $hole): self
    {
        if (!$this->holes->contains($hole)) {
            $this->holes->add($hole);
            $hole->setCourse($this);
        }

        return $this;
    }

    public function removeHole(Hole $hole): self
    {
        if ($this->holes->removeElement($hole)) {
            // set the owning side to null (unless already changed)
            if ($hole->getCourse() === $this) {
                $hole->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): self
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
            $tournament->setCourse($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): self
    {
        if ($this->tournaments->removeElement($tournament)) {
            // set the owning side to null (unless already changed)
            if ($tournament->getCourse() === $this) {
                $tournament->setCourse(null);
            }
        }

        return $this;
    }
}
