<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class StudentsTest extends UnitTestCase
{
    /**
     * @var \NITSAN\NsCourses\Domain\Model\Students|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \NITSAN\NsCourses\Domain\Model\Students::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName(): void
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('name'));
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail(): void
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('email'));
    }

    /**
     * @test
     */
    public function getCourseReturnsInitialValueForCourse(): void
    {
        self::assertEquals(
            null,
            $this->subject->getCourse()
        );
    }

    /**
     * @test
     */
    public function setCourseForCourseSetsCourse(): void
    {
        $courseFixture = new \NITSAN\NsCourses\Domain\Model\Course();
        $this->subject->setCourse($courseFixture);

        self::assertEquals($courseFixture, $this->subject->_get('course'));
    }
}
