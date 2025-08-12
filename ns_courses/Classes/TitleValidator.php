<?php




namespace NITSAN\NsCourses;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

use TYPO3\CMS\Core\Resource\FileReference as CoreFileReference;


final class TitleValidator extends AbstractValidator
{
    protected function isValid(mixed $value): void
    {
        // $value is the title string


        if ($value === null || trim($value) === '') {
            
            $this->addError('The title cannot be empty.', 1700001000);
             debug($value);die();
            return;
        }
        // if (str_starts_with('_', $value)) {
        //     $errorString = 'The title may not start with an underscore. ';
        //     $this->addError($errorString, 1297418976);
        // }
    }
}
