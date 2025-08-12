<?php
defined('TYPO3') || die();



// \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
//     'NsCourses',
//     'Course',
//     'course'
// );
// ExtensionManagementUtility::addPlugin(
//   ['Course Plugin', 'nscourses_course', 'EXT:ns_courses/Resources/Public/Icons/course.svg'],
//   'list_type',                 // ✅ Correct for plugins
//   'ns_courses'                // ✅ Extension key is required in TYPO3 v13
// );

// Optional: Add flexform if you use it
// ExtensionManagementUtility::addPiFlexFormValue(
//   'nscourses_course',
//   'FILE:EXT:ns_courses/Configuration/FlexForms/Course.xml'
// );

// \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
//     'NsCourses',
//     'Student',
//     'student'
// ); 

// ExtensionManagementUtility::addPlugin(
//   ['Student Plugin', 'nscourses_student', 'EXT:ns_courses/Resources/Public/Icons/student.svg'],
//   'list_type',
//   'ns_courses'
// );

// ExtensionManagementUtility::addPiFlexFormValue(
//   'nscourses_student',
//   'FILE:EXT:ns_courses/Configuration/FlexForms/Student.xml'
// );





use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// Extension key
$extensionKey = 'ns_courses';

// Plugin details
$pluginName = 'Student'; // CamelCase
$pluginTitle = 'Student Plugin'; // Backend label


// Register the plugin
$pluginSignature = ExtensionUtility::registerPlugin(
    $extensionKey,
    $pluginName,
    $pluginTitle
);

// // // Register FlexForm XML for the plugin
// ExtensionManagementUtility::addPiFlexFormValue(
//     $pluginSignature,
//     'FILE:EXT:ns_courses/Configuration/FlexForms/Student.xml'
// );

// Optional: Clean up unwanted fields and show FlexForm tab
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key, pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

// Add pi_flexform tab position (optional)
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform',
    $pluginSignature,
    'after:subheader'
);
//--- Plugin 2: Course ---
$coursePluginName = 'Course'; // CamelCase
$coursePluginTitle = 'Course Plugin'; // Backend label

$coursePluginSignature = ExtensionUtility::registerPlugin(
    $extensionKey,
    $coursePluginName,
    $coursePluginTitle
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$coursePluginSignature] = 'select_key, pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$coursePluginSignature] = 'pi_flexform';

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform',
    $coursePluginSignature,
    'after:subheader'
);



