<?php

namespace App\Service;


use App\Dto\Incoming\CreateCourseDto;
use App\Dto\Outgoing\CourseResponseDto;
use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Serialization\JsonSerializer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hole;
use Symfony\Component\HttpFoundation\Response;

class CourseService extends AbstractMultiTransformer
{

    private EntityManagerInterface $entityManager;
    private CourseRepository $courseRepository;
    private HoleService $holeService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param CourseRepository $courseRepository
     * @param HoleService $holeService
     */
    public function __construct(EntityManagerInterface $entityManager, CourseRepository $courseRepository, HoleService $holeService)
    {
        $this->entityManager = $entityManager;
        $this->courseRepository = $courseRepository;
        $this->holeService = $holeService;
    }


    public function createNewCourse( CreateCourseDto $courseDto):Course
    {
        $course = new Course();
        $course->setName($courseDto->getCourseName());
        $course->setCoursePar($courseDto->getCoursePar());

        $this->entityManager->persist($course);

        $holes = $courseDto->getHoles();

        foreach($holes as $hole) {
            $newHole = new hole(
                $hole->getPar(),
                $hole->getParkedRate(),
                $hole->getC1Rate(),
                $hole->getC2Rate(),
                $hole->getScrambleRate(),
                $course
            );
            $this->entityManager->persist($newHole);
        }

        $this->entityManager->flush();
        return $course;
    }

    public function getCourseById(int $id): Course
    {
        return $this->courseRepository->findOneBy(['course_id' => $id]);
    }

    public function getCourseByIdDto(int $id): CourseResponseDto
    {
        $course = $this->courseRepository->findOneBy(['course_id' => $id]);
        return $this->transformFromObject($course);
    }

    public function deleteCourse(int $id): string
    {
        $course = $this->courseRepository->find($id);
        $this->entityManager->remove($course);
        $this->entityManager->flush();
        return "deleted tournament with id: {$id}";
    }

    public function getCourses(): iterable
    {
        return $this->courseRepository->findAll();
    }

    public function getCoursesDto(): iterable
    {
        $allCourses = $this->courseRepository->findAll();
        return $this->transformFromObjects($allCourses);
    }

    /**
     * @param Course $object
     * @return CourseResponseDto void
     */
    public function transformFromObject($object): CourseResponseDto
    {
        $dto = new CourseResponseDto();
        $dto->setCourseId($object->getCourseId());
        $dto->setName($object->getName());
        $dto->setCoursePar($object->getCoursePar());
        $holes = $this->holeService->getAllHolesByCourseIdDto($object->getCourseId());
        $dto->setHoles($holes);

        return $dto;
    }


}