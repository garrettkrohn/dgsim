<?php

namespace App\Service;


use App\Entity\Course;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Hole;

class CourseService
{

    private EntityManagerInterface $entityManager;
    private CourseRepository $courseRepository;

    public function __construct(EntityManagerInterface $entityManager, CourseRepository $courseRepository)
    {
        $this->entityManager = $entityManager;
        $this->courseRepository = $courseRepository;
    }

    public function createNewCourse():Course
    {
        $course = new Course();
        $course->setName('test course');
        $course->setCoursePar(66);

        $this->entityManager->persist($course);

        //create the holes
        $h1 = new hole(4, 0.1367, 0.54, 0.7667, 0.5367, $course);
        $this->entityManager->persist($h1);
        $h2 = new hole(3, 0.04, 0.2034, 0.3934, 0.5567, $course);
        $this->entityManager->persist($h2);
        $h3 = new hole(3, 0.0634, 0.3167, 0.67, 0.4334, $course);
        $this->entityManager->persist($h3);
        $h4 = new hole(4, 0.02, 0.1534, 0.2567, 0.5967, $course);
        $this->entityManager->persist($h4);
        $h5 = new hole(4, 0.0134, 0.04, 0.0967, 0.3567, $course);
        $this->entityManager->persist($h5);
        $h6 = new hole(3, 0.1234, 0.41, 0.66, 0.9134, $course);
        $this->entityManager->persist($h6);
        $h7 = new hole(5, 0.0934, 0.3867, 0.6267, 0.55, $course);
        $this->entityManager->persist($h7);
        $h8 = new hole(3, 0.14, 0.5534, 0.8734, 0.5467, $course);
        $this->entityManager->persist($h8);
        $h9 = new hole(5, 0.12, 0.4067, 0.6434, 0.7967, $course);
        $this->entityManager->persist($h9);
        $h10 = new hole(3, 0.0667, 0.3234, 0.7067, 0.07, $course);
        $this->entityManager->persist($h10);
        $h11 = new hole(4, 0.0234, 0.1567, 0.3034, 0.3767, $course);
        $this->entityManager->persist($h11);
        $h12 = new hole(3, 0.0434, 0.2967, 0.6167, 0.4634, $course);
        $this->entityManager->persist($h12);
        $h13 = new hole(3, 0.1034, 0.4667, 0.7167, 0.3734, $course);
        $this->entityManager->persist($h13);
        $h14 = new hole(4, 0.0734, 0.34, 0.59, 0.28, $course);
        $this->entityManager->persist($h14);
        $h15 = new hole(4, 0.1334, 0.5067, 0.7667, 0.61, $course);
        $this->entityManager->persist($h15);
        $h16 = new hole(3, 0.0334, 0.4, 0.8, 0.5367, $course);
        $this->entityManager->persist($h16);
        $h17 = new hole(3, 0.1, 0.5, 0.6934, 0.5567, $course);
        $this->entityManager->persist($h17);
        $h18 = new hole(5, 0.25, 0.5267, 0.75, 0.5034, $course);
        $this->entityManager->persist($h18);

        $this->entityManager->flush();
        return $course;
    }

    public function getCourseById(int $id): Course
    {
        return $this->courseRepository->findOneBy(array('course_id' => $id));
    }
}