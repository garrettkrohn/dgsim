<?php

namespace App\Controller;

use App\Serialization\JsonSerializer;
use App\Service\CourseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    private CourseService $courseService;
    private JsonSerializer $serializer;

    public function __construct(CourseService $courseService, JsonSerializer $serializer)
    {
        $this->courseService = $courseService;
        $this->serializer = $serializer;
    }


    #[Route('/api/courses', methods: ['POST'])]
    public function createCourse():Response
    {
        $course = $this->courseService->createNewCourse();
        return new JsonResponse($course);
    }

    #[Route('api/courses', methods: ['GET'])]
    public function getCourses(): Response
    {
        return $this->json($this->courseService->getCoursesDto());
    }

}