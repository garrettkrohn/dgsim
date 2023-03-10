<?php

namespace App\Controller;

use App\Dto\Incoming\CreateCourseDto;
use App\Serialization\JsonSerializer;
use App\Serialization\SerializationService;
use App\Service\CourseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends ApiController
{
    private CourseService $courseService;
    private SerializationService $serializationService;

    /**
     * @param CourseService $courseService
     */
    public function __construct(CourseService $courseService, SerializationService $serializationService)
    {
        parent::__construct($serializationService);
        $this->courseService = $courseService;
    }

    #[Route('/api/courses', methods: ['POST'])]
    public function createCourse(Request $request):Response
    {
        $dto = $this->getValidatedDto($request, CreateCourseDto::class);
//        $course = $this->courseService->createNewCourse();
        return new JsonResponse('$course');
    }

    #[Route('api/courses', methods: ['GET'])]
    public function getCourses(): Response
    {
        return $this->json($this->courseService->getCoursesDto());
    }

}