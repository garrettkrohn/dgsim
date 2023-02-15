<?php

namespace App\Dto\Response;

class CourseResponseDto
{
    public int $course_id;
    public string $name;
    public int $course_par;
    public iterable $holeResponseDto;

}