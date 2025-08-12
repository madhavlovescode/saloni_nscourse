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
class StudentsControllerTest extends UnitTestCase
{
    /**
     * @var \NITSAN\NsCourses\Controller\StudentsController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\NITSAN\NsCourses\Controller\StudentsController::class))
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
    public function listActionFetchesAllStudentsFromRepositoryAndAssignsThemToView(): void
    {
        $allStudents = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $studentsRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\StudentsRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $studentsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allStudents));
        $this->subject->_set('studentsRepository', $studentsRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('students', $allStudents);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenStudentsToView(): void
    {
        $students = new \NITSAN\NsCourses\Domain\Model\Students();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('students', $students);

        $this->subject->showAction($students);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenStudentsToStudentsRepository(): void
    {
        $students = new \NITSAN\NsCourses\Domain\Model\Students();

        $studentsRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\StudentsRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $studentsRepository->expects(self::once())->method('add')->with($students);
        $this->subject->_set('studentsRepository', $studentsRepository);

        $this->subject->createAction($students);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenStudentsToView(): void
    {
        $students = new \NITSAN\NsCourses\Domain\Model\Students();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('students', $students);

        $this->subject->editAction($students);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenStudentsInStudentsRepository(): void
    {
        $students = new \NITSAN\NsCourses\Domain\Model\Students();

        $studentsRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\StudentsRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $studentsRepository->expects(self::once())->method('update')->with($students);
        $this->subject->_set('studentsRepository', $studentsRepository);

        $this->subject->updateAction($students);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenStudentsFromStudentsRepository(): void
    {
        $students = new \NITSAN\NsCourses\Domain\Model\Students();

        $studentsRepository = $this->getMockBuilder(\NITSAN\NsCourses\Domain\Repository\StudentsRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $studentsRepository->expects(self::once())->method('remove')->with($students);
        $this->subject->_set('studentsRepository', $studentsRepository);

        $this->subject->deleteAction($students);
    }
}
