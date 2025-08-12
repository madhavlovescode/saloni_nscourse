<?php



namespace NITSAN\NsCourses\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\Validate;
use NITSAN\NsCourses\TitleValidator;
use NITSAN\NsCourses\PdfFileValidator;

/**
 * This file is part of the "Accesstive Administration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025 
 */

/**
 * Course
 */
class Course extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{


    /**
     * title
     *
     * @var string
     */
 
    #[Validate([
        'validator' => TitleValidator::class,
    ])]
    protected string $title='';

    /**
     * description
     *
     * @var string
     */

    #[Validate([
    'validator' => 'StringLength',
    'options' => ['minimum' => 5, 'maximum' => 50],
    ])]
    protected $description = '';

 /**
 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
 
 * @TYPO3\CMS\Extbase\Annotation\Validate("NITSAN\NsCourses\PdfFileValidator")
 */

//#[Validate(['validator' => 'NotEmpty'])]
#[Validate(['validator' => PdfFileValidator::class])]
    protected $file ;
    

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the file
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getFile(): ?FileReference
    {
        return $this->file;
    }

    /**
     * Sets the file
     *
     * @param ?FileReference $file
     * @return void
     */
    public function setFile(?FileReference $file)
    {
        $this->file = $file;
    }
}
