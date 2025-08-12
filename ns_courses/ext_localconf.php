<?php
defined('TYPO3') || die();

(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NsCourses',
        //'NITSAN.NsCourses',
        'Course',
        [
            \NITSAN\NsCourses\Controller\CourseController::class => 'list, show, new, create, edit, update, delete',
            \NITSAN\NsCourses\Controller\StudentsController::class => 'list, show, new, create, edit, update, delete',
        ],
        [
            \NITSAN\NsCourses\Controller\CourseController::class => 'create, update, delete',
            \NITSAN\NsCourses\Controller\StudentsController::class => 'create, update, delete',
        ] ,
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NsCourses',
        'Student',
        [
            \NITSAN\NsCourses\Controller\StudentsController::class => 'list, show, new, create, edit, update, delete',
        ],
        [
            \NITSAN\NsCourses\Controller\StudentsController::class => 'create, update, delete',
        ] ,
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // ✅ Register TypoScript Setup
    // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    //     'ns_courses',
    //     'Configuration/TypoScript',
    //     'NS Courses'
    // );

    // wizards
    // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    //     'mod {
    //         wizards.newContentElement.wizardItems.plugins {
    //             elements {
    //                 course {
    //                     iconIdentifier = ns_courses-plugin-course
    //                     title = LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_ns_courses_course.name
    //                     description = LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_ns_courses_course.description
    //                     tt_content_defValues {
    //                         CType = list
    //                         list_type = nscourses_course
    //                     }
    //                 }
    //                 student {
    //                     iconIdentifier = ns_courses-plugin-student
    //                     title = LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_ns_courses_student.name
    //                     description = LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_ns_courses_student.description
    //                     tt_content_defValues {
    //                         CType = list
    //                         list_type = nscourses_student
    //                     }
    //                 }
    //             }
    //             show = *
    //         }
    //     }'
    // );

    // Optional: File reference override
    $GLOBALS['TYPO3_CONF_VARS']['Extbase']['objectContainer'][TYPO3\CMS\Extbase\Domain\Model\FileReference::class] =
        TYPO3\CMS\Extbase\Domain\Repository\FileReferenceRepository::class;


        $GLOBALS['TYPO3_CONF_VARS']['LOG']['NITSAN']['ns_faq']['writerConfiguration'] = [
        \TYPO3\CMS\Core\Log\LogLevel::NOTICE => [
        \TYPO3\CMS\Core\Log\Writer\DatabaseWriter::class => [],
        \TYPO3\CMS\Core\Log\Writer\SyslogWriter::class => [
            'facility' => LOG_USER,
        ],
    ],
];

// EXT:ns_courses/ext_localconf.php

$GLOBALS['TYPO3_CONF_VARS']['LOG']['NITSAN']['NsCourses']['writerConfiguration'] = [
    \TYPO3\CMS\Core\Log\LogLevel::NOTICE => [
        \TYPO3\CMS\Core\Log\Writer\DatabaseWriter::class => ['facility' => LOG_USER,],
    ],
];
// $GLOBALS['TYPO3_CONF_VARS']['LOG']['NITSAN']['NsCourses']['writerConfiguration'] = [
//     \TYPO3\CMS\Core\Log\LogLevel::DEBUG => [
//         \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
//             'logFile' => \TYPO3\CMS\Core\Core\Environment::getVarPath() . '/log/ns_courses.log',
//         ],
//     ],
// ];


})();
