<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Domain\Model;
use TYPO3\CMS\Extbase\Annotation\Validate;

/**
 * This file is part of the "Accesstive Administration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025 
 */

/**
 * Students
 */
class Students extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    #[Validate(['validator' => 'Alphanumeric'])]
    //protected string $name;
    protected $name = '';

    /**
     * email
     *
     * @var string
     */
   #[Validate(['validator' => 'EmailAddress'])]      
    protected string $email = '';

    /**
     * course
     *
     * @var \NITSAN\NsCourses\Domain\Model\Course
     */
    protected $course = null;

 #[Validate([
        'validator' => 'RegularExpression',
        'options' => [
            'regularExpression' => '/^\d{10}$/',
            'message' => 'Number should be of ten digit.'
        ]
    ])]
 protected $number = '';

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

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
     * Returns the course
     *
     * @return \NITSAN\NsCourses\Domain\Model\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Sets the course
     *
     * @param \NITSAN\NsCourses\Domain\Model\Course $course
     * @return void
     */
    public function setCourse( ?\NITSAN\NsCourses\Domain\Model\Course $course)
    {
        $this->course = $course;
    }


       /**
     * Returns the number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets the n
     *
     * @param string $number
     * @return void
     */
    public function setNumber(string $number)
    {
        $this->number = $number;
    }
}
