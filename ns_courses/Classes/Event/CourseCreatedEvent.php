<?php

declare(strict_types=1);

// namespace NITSAN\NsCourses\Event;

// use Psr\EventDispatcher\EventDispatcherInterface;

// final class CourseCreatedEvent
// {


//     public function __construct(
//         public readonly Course $course
//     ) {}

//     public function getCourse(): Course
//     {
//         return $this->course;
//     }
// }



namespace NITSAN\NsCourses\Event;

use NITSAN\NsCourses\Domain\Model\Course;

use Psr\Log\LoggerInterface;


final class CourseCreatedEvent
{
    public function __construct(
        public readonly Course $course
    ) {}

    public function getCourse(): Course
    {
        return $this->course;
    }
}



