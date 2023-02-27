<?php

namespace App\Dto\Outgoing;

class CourseResponseDto
{
    public int $course_id;
    public string $name;
    public int $course_par;
    public iterable $holes;

    /**
     * @return int
     */
    public function getCourseId(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setCourseId(int $course_id): void
    {
        $this->course_id = $course_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCoursePar(): int
    {
        return $this->course_par;
    }

    /**
     * @param int $course_par
     */
    public function setCoursePar(int $course_par): void
    {
        $this->course_par = $course_par;
    }

    /**
     * @return iterable
     */
    public function getHoles(): iterable
    {
        return $this->holes;
    }

    /**
     * @param iterable $holes
     */
    public function setHoles(iterable $holes): void
    {
        $this->holes = $holes;
    }



}