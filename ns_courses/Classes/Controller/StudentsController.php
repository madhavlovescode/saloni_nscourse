<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Controller;
use NITSAN\NsCourses\Domain\Repository\StudentsRepository;
use NITSAN\NsCourses\Domain\Repository\CourseRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Accesstive Administration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025 
 */

/**
 * StudentsController
 */
class StudentsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{   

    public function __construct(
        protected StudentsRepository $studentsRepository,
        protected CourseRepository $courseRepository
    ){}

    // /**
    //  * studentsRepository
    //  *
    //  * @var \NITSAN\NsCourses\Domain\Repository\StudentsRepository
    //  */
    // protected $studentsRepository = null;
    // protected $courseRepository = null;

    // /**
    //  * @param \NITSAN\NsCourses\Domain\Repository\StudentsRepository $studentsRepository
    //  */
    // public function injectStudentsRepository(\NITSAN\NsCourses\Domain\Repository\StudentsRepository $studentsRepository)
    // {
    //     $this->studentsRepository = $studentsRepository;
        
    // }

    // /**
    //  * @param \NITSAN\NsCourses\Domain\Repository\CourseRepository $courseRepository
    //  */
    // public function injectCourseRepository(\NITSAN\NsCourses\Domain\Repository\CourseRepository $courseRepository)
    // {
    //     $this->courseRepository = $courseRepository;
    // }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $students = $this->studentsRepository->findAll();
        $this->view->assign('students', $students);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \NITSAN\NsCourses\Domain\Model\Students $students
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\NITSAN\NsCourses\Domain\Model\Students $students): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('students', $students);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): ResponseInterface
{
    if ($this->courseRepository === null) {
        throw new \RuntimeException('CourseRepository is not injected.');
    }
    $courses = $this->courseRepository->findAll();
    $this->view->assign('courses', $courses);
    return $this->htmlResponse();
}

    /**
     * action create
     *
     * @param \NITSAN\NsCourses\Domain\Model\Students $newStudents
     */
   public function createAction (\NITSAN\NsCourses\Domain\Model\Students $newStudents)
    {
        $arguments = $this->request->getArguments();
        $courseUid = $arguments['students']['course'] ?? null;
        if ($courseUid) {
            $course = $this->courseRepository->findByUid((int)$courseUid); // Cast to int for safety
            $newStudents->setCourse($course ?: null); // Set null if course not found
        } else {
            if ($courseUid && ($course = $this->courseRepository->findByUid((int)$courseUid))) {
                $newStudents->setCourse($course);
}
        }
        // $this->addFlashMessage('Course was successfully created.','Success');

        $this->studentsRepository->add($newStudents);
       return $this->redirect('list');
    }
    /**
     * action edit
     *
     * @param \NITSAN\NsCourses\Domain\Model\Students $students
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("students")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\NITSAN\NsCourses\Domain\Model\Students $students): ResponseInterface
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('students', $students);
        $this->view->assign('courses', $courses);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \NITSAN\NsCourses\Domain\Model\Students $students
     */
    public function updateAction(\NITSAN\NsCourses\Domain\Model\Students $students)
    {
        // Retrieve course UID from the request arguments
        $arguments = $this->request->getArguments();
        $courseUid = $arguments['students']['course'] ?? null;
        if ($courseUid) {
            $course = $this->courseRepository->findByUid($courseUid);
            if ($course) {
                $students->setCourse($course);
            } else {
                $students->setCourse(null);
            }
        } else {
            $students->setCourse(null);
        }
        $this->addFlashMessage('Course was successfully updated.','Success');

        $this->studentsRepository->update($students);
return  $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \NITSAN\NsCourses\Domain\Model\Students $students
     */
   public function deleteAction(\NITSAN\NsCourses\Domain\Model\Students $students)
{
     $this->addFlashMessage('Course was successfully deleted.','Success');

    $this->studentsRepository->remove($students);
return $this->redirect('list');
}
}