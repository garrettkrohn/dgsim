<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCourseDto
{
    #[NotNull]
    #[Type('string')]
    public string $courseName;

    #[NotNull]
    #[Type('int')]
    public int $coursePar;

    /**
     * @Assert\All({
     *    @Assert\Type("App\Dto\Incoming\CreateHoleDto")
     * })
     * @Assert\Valid
     * @var CreateHoleDto[]
     */
    public array $holes;

    /**
     * @return string
     */
    public function getCourseName(): string
    {
        return $this->courseName;
    }

    /**
     * @param string $courseName
     */
    public function setCourseName(string $courseName): void
    {
        $this->courseName = $courseName;
    }

    /**
     * @return int
     */
    public function getCoursePar(): int
    {
        return $this->coursePar;
    }

    /**
     * @param int $coursePar
     */
    public function setCoursePar(int $coursePar): void
    {
        $this->coursePar = $coursePar;
    }

    /**
     * @return array
     */
    public function getHoles(): array
    {
        return $this->holes;
    }

    /**
     * @param array $holes
     */
    public function setHoles(array $holes): void
    {
        $this->holes = $holes;
    }

}