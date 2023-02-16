<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\CourseResponseDto;
use App\Entity\Course;

class CourseResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private HoleSimResponseDtoTransformer $transformer;

    public function __construct(HoleSimResponseDtoTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param Course $object
     * @return CourseResponseDto
     */
    public function transformFromObject($object): CourseResponseDto
    {
        $dto = new CourseResponseDto();
        $dto->course_id = $object->getCourseId();
        $dto->name = $object->getName();
        $dto->course_par = $object->getCoursePar();
        $holes = $object->getHoles();
        $holesTransformed = $this->transformer->transformFromObjects($holes);
        $dto->holeResponseDto = $holesTransformed;
        return $dto;
    }

}