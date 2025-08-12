<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Controller;


use TYPO3\CMS\Core\Resource\File;
use Psr\Http\Message\ResponseInterface;
use NITSAN\NsCourses\Domain\Model\Course;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use NITSAN\NsCourses\Domain\Repository\CourseRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use NITSAN\NsCourses\Domain\Repository\LogRepository;
use Psr\Log\LoggerInterface;
use NITSAN\NsCourses\Event\CourseCreatedEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

class CourseController extends ActionController
{

// public function __construct(
//     protected CourseRepository $courseRepository,
//     protected PersistenceManager $persistenceManager,
//     protected FileRepository $fileRepository,
//     //protected LogRepository $logRepository,
//     protected LoggerInterface $logger,

// ) {
// }

public function __construct(
        protected CourseRepository $courseRepository,
        protected PersistenceManager $persistenceManager,
        protected FileRepository $fileRepository,
        protected LogRepository $logRepository,
        protected LoggerInterface $logger,
        protected EventDispatcherInterface $eventDispatcher
    ) {}
// protected LogRepository $logRepository;

// public function injectLogRepository(LogRepository $logRepository): void
// {
//     $this->logRepository = $logRepository;
// }

// public function injectEventDispatcher(EventDispatcherInterface $eventDispatcher): void
// {
//     $this->eventDispatcher = $eventDispatcher;
// }


    

//     protected $persistenceManager;

// public function injectPersistenceManager(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager): void
// {
//     $this->persistenceManager = $persistenceManager;
// }
// /**
//  * @var \TYPO3\CMS\Extbase\Persistence\RepositoryInterface
//  */
// protected $fileReferenceRepository;

// public function injectFileReferenceRepository(\TYPO3\CMS\Extbase\Persistence\RepositoryInterface $fileReferenceRepository): void
// {
//     $this->fileReferenceRepository = $fileReferenceRepository;
// }

    public function indexAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function listAction(): ResponseInterface
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
        return $this->htmlResponse();
    }

    public function showAction(Course $course): ResponseInterface
    {
        $this->view->assign('course', $course);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        $newCourse = new Course();
        $this->view->assign('newCourse', $newCourse);
        return $this->htmlResponse();
    }

  
    public function createAction(Course $newCourse): ResponseInterface
    {
        try {
            $this->courseRepository->add($newCourse);
            $this->persistenceManager->persistAll();

            if (isset($_FILES['tx_nscourses_course']['tmp_name']['file']) && is_uploaded_file($_FILES['tx_nscourses_course']['tmp_name']['file'])) {
                $tmpName = $_FILES['tx_nscourses_course']['tmp_name']['file'];
                $fileName = $_FILES['tx_nscourses_course']['name']['file'];
                $fileSize = $_FILES['tx_nscourses_course']['size']['file'];
                $fileError = $_FILES['tx_nscourses_course']['error']['file'];

                if ($fileError === UPLOAD_ERR_OK && $fileSize > 0) {
                    $newFile = $this->getUploadedFileData($tmpName, $fileName);
                    $fileData = $newFile->getProperties();

                    if ($fileData && isset($fileData['uid'])) {
                        $this->courseRepository->updateSysFileReferenceRecord(
                            (int)$fileData['uid'],
                            (int)$newCourse->getUid(),
                            (int)$newCourse->getPid(),
                            'tx_nscourses_domain_model_course',
                            'file'
                        );

                        $fileObjects = $this->fileRepository->findByRelation(
                            'tx_nscourses_domain_model_course',
                            'file',
                            $newCourse->getUid()
                        );
                    } else {
                        throw new \RuntimeException('Failed to retrieve file properties or uid');
                    }
                } else {
                    throw new \RuntimeException('File upload error: ' . $this->getUploadErrorMessage($fileError));
                }
            }
            $event = new CourseCreatedEvent($newCourse);
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($event, 'Event');
$this->eventDispatcher->dispatch($event);

            // Dispatch custom event
            //$this->eventDispatcher->dispatch( new CourseCreatedEvent($newCourse));
//  debug($value);die();
            // Log the event
            $event = new CourseCreatedEvent($newCourse);
$this->eventDispatcher->dispatch($event);

            //$this->logger->info('Course created: ' . $newCourse->getTitle());

        } catch (\Exception $exception) {
            $this->addFlashMessage('An error occurred: ' . $exception->getMessage(), 'Error');
            $this->logger->error('Course creation failed: ' . $exception->getMessage());
        }

        return $this->redirect('list');
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("course")
     */
//  public function updateAction(Course $course) : \Psr\Http\Message\ResponseInterface
//     {
//         if($_FILES['tx_nscourses_course']['tmp_name']['file']){
//             $newFile = $this->getUploadedFileData($_FILES['tx_nscourses_course']['tmp_name']['file'], $_FILES['tx_nscourses_course']['name']['file']);
//             $fileData = $newFile->getProperties();
//             if ($fileData) {
//                 $this->courseRepository->updateSysFileReferenceRecord(
//                     (int)$fileData['uid'],
//                     (int)$course->getUid(),
//                     (int)$course->getPid(),
//                     'tx_nscourses_domain_model_course',
//                     'file'
//                 );
//                 $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
//                 $fileObjects = $fileRepository->findByRelation(
//                     'tx_nscourses_domain_model_course',
//                     'file',
//                     $course->getUid()
//                 );
//             }
//         }
//         $this->courseRepository->update($course);
//         $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html','');
//       return $this->redirect('list');
//     }
    

   /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("course")
     */
    public function deleteAction(Course $course): ResponseInterface
    {
        $this->courseRepository->remove($course);
        $this->addFlashMessage('Course deleted.');
        return $this->redirect('list');
    }

    private function getUploadedFileData(string $tmpName, string $fileName): File
    {
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $storage = $resourceFactory->getDefaultStorage();
        $folderPath = $storage->getRootLevelFolder();
        $newFile = $storage->addFile($tmpName, $folderPath,$fileName);
        return $newFile;

    }
   /**
     * action edit
     *
     * @param \NITSAN\NsCourses\Domain\Model\Course $course
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("course")
     * @return \Psr\Http\Message\ResponseInterface
     */
    // public function editAction(\NITSAN\NsCourses\Domain\Model\Course $course): ResponseInterface
    // {
    //     $courses = $this->courseRepository->findAll();

    //      $this->view->assign('course', $course);
    // $this->view->assign('courses', $courses);
    //  // $this->view->assign('courses', $courses);
    //     return $this->htmlResponse();
    // }


     public function editAction(Course $course): ResponseInterface
    {
        $this->view->assign('course', $course);
        return $this->htmlResponse();
    }

   public function updateAction(Course $course): ResponseInterface
{
    // Remove existing file reference(s)
    $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
    $references = $fileRepository->findByRelation(
        'tx_nscourses_domain_model_course',
        'file',
        $course->getUid()
    );

    foreach ($references as $reference) {
        $this->deleteFileReference((int)$reference->getUid());
    }

    // Handle new file upload
    if (!empty($_FILES['tx_nscourses_course']['tmp_name']['file'])) {
        $newFile = $this->getUploadedFileData(
            $_FILES['tx_nscourses_course']['tmp_name']['file'],
            $_FILES['tx_nscourses_course']['name']['file']
        );
        $fileData = $newFile->getProperties();

        if ($fileData) {
            $this->courseRepository->updateSysFileReferenceRecord(
                (int)$fileData['uid'],
                (int)$course->getUid(),
                (int)$course->getPid(),
                'tx_nscourses_domain_model_course',
                'file'
            );
        }
    }

    $this->courseRepository->update($course);
    $this->addFlashMessage('Course updated.', '');
    return $this->redirect('list');
}
    protected function deleteFileReference(int $referenceUid): void
{
    $connection = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable('sys_file_reference');
    $connection->delete('sys_file_reference', ['uid' => $referenceUid]);
}

}

