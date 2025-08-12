<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 */
class CourseControllerTest extends UnitTestCase
{
    /**
     * @var \NITSAN\NsCourses\Controller\CourseController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\NITSAN\NsCourses\Controller\CourseController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllCoursesFromRepositoryAndAssignsThemToView(): void
    {
        $allCourses = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $courseRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\CourseRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $courseRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCourses));
        $this->subject->_set('courseRepository', $courseRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('courses', $allCourses);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCourseToView(): void
    {
        $course = new \NITSAN\NsCourses\Domain\Model\Course();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('course', $course);

        $this->subject->showAction($course);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCourseToCourseRepository(): void
    {
        $course = new \NITSAN\NsCourses\Domain\Model\Course();

        $courseRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\CourseRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $courseRepository->expects(self::once())->method('add')->with($course);
        $this->subject->_set('courseRepository', $courseRepository);

        $this->subject->createAction($course);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCourseToView(): void
    {
        $course = new \NITSAN\NsCourses\Domain\Model\Course();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('course', $course);

        $this->subject->editAction($course);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCourseInCourseRepository(): void
    {
        $course = new \NITSAN\NsCourses\Domain\Model\Course();

        $courseRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\CourseRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $courseRepository->expects(self::once())->method('update')->with($course);
        $this->subject->_set('courseRepository', $courseRepository);

        $this->subject->updateAction($course);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCourseFromCourseRepository(): void
    {
        $course = new \NITSAN\NsCourses\Domain\Model\Course();

        $courseRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\CourseRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $courseRepository->expects(self::once())->method('remove')->with($course);
        $this->subject->_set('courseRepository', $courseRepository);

        $this->subject->deleteAction($course);
    }
}
