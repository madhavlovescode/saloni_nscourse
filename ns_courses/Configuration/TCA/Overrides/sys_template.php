<?php
if (!isset($GLOBALS['TCA']['sys_template'])) {
    file_put_contents('/tmp/tca-debug.log', "sys_template not set\n", FILE_APPEND);
}

defined('TYPO3') || die();

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ns_courses', 'Configuration/TypoScript', 'course');


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'ns_courses',
    'Configuration/TypoScript',
    'course'
);
// ✅ Register TypoScript Setup
    // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    //     'ns_courses',
    //     'Configuration/TypoScript',
    //     'NS Courses'
    // );
