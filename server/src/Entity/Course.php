<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $course_par = null;

    #[ORM\OneToMany(mappedBy: 'course_id', targetEntity: Hole::class)]
    private Collection $holes;

    public function __construct()
    {
        $this->holes = new ArrayCollection();
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
            $hole->setCourseId($this);
        }

        return $this;
    }

    public function removeHole(Hole $hole): self
    {
        if ($this->holes->removeElement($hole)) {
            // set the owning side to null (unless already changed)
            if ($hole->getCourseId() === $this) {
                $hole->setCourseId(null);
            }
        }

        return $this;
    }
}
