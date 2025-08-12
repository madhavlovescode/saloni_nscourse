<?php

declare(strict_types=1);


namespace NITSAN\NsCourses;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

use TYPO3\CMS\Core\Resource\FileReference as CoreFileReference;
use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
final class PdfFileValidator extends AbstractValidator
{
    
    private const MAX_FILE_SIZE = 5242880;


   protected function isValid(mixed $value): void
{
   
    // if (empty($value)) {
    //     $this->addError('File is required.', 1700000000);
    //     return;
    // }

        // $fileReference = is_array($value) ? $value[0] ?? null : $value;

        // if (!$fileReference instanceof CoreFileReference) {
        //     $this->addError('Invalid file upload.', 1700000002);
        //     return;
        // }

        // $file = $fileReference->getOriginalResource();

        // $extension = strtolower($file->getExtension());
        // $size = $file->getSize();
        print_r("hello");

        if ($extension !== 'pdf') {
            var_dump($extension, 'Validator value');
            die();
            // Optionally delete invalid file
            //$file->getStorage()->deleteFile($file);
            $this->addError('Only PDF files are allowed.', 1700000001);
            return;
        }

        if ($size > self::MAX_FILE_SIZE) {
            // Optionally delete invalid file
            //$file->getStorage()->deleteFile($file);
            $this->addError('File size must not exceed 5 MB.', 1700000003);
            return;
        }
    }
}



// final class PdfFileValidator extends AbstractValidator
// {
//     /**
//      * Validate that the uploaded file is a PDF
//      *
//      * @param mixed $value
//      */
//     protected function isValid(mixed $value): void
//     {
//         if ($value instanceof FileReference || (is_array($value) && isset($value[0]) && $value[0] instanceof FileReference)) {
//             $fileReference = is_array($value) ? $value[0] : $value;
//             $file = $fileReference->getOriginalResource();

//             if ($file->getExtension() !== 'pdf') {
//                 $this->addError('Only PDF files are allowed.', 1700000001);
//             }
//         } else {
//             $this->addError('Invalid file upload.', 1700000002);
//         }
//     }
// }