<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Event;

use TYPO3\CMS\Core\Attribute\AsEventListener;
use Psr\Log\LoggerInterface;

#[AsEventListener(
    identifier: 'ns_courses/course-created-listener'
)]
final class CourseCreatedEventListener
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(CourseCreatedEvent $event): void
    {
        $course = $event->getCourse();
        $this->logger->info('Course created: ' . $course->getTitle(), [
            'uid' => $course->getUid(),
        ]);
    }
}
