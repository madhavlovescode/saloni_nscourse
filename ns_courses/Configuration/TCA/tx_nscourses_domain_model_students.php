<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,email',
        'iconfile' => 'EXT:ns_courses/Resources/Public/Icons/tx_nscourses_domain_model_students.gif',        
    ],

    'types' => [
        '1' => [
            'showitem' => 'name, email, course, 
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, 
                sys_language_uid, l10n_parent, l10n_diffsource, 
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                hidden, starttime, endtime'
        ],
    ],

    'columns' => [

        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],

        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    [
                        'label' => '',
                        'value' => 0
                    ],
                ],
                'foreign_table' => 'tx_nscourses_domain_model_students',
                'foreign_table_where' => 'AND {#tx_nscourses_domain_model_students}.{#pid}=###CURRENT_PID### AND {#tx_nscourses_domain_model_students}.{#sys_language_uid} IN (-1,0)',
            ],
        ],

        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],

        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],

        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],

        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.name',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.name.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '',
            ],
        ],

        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.email',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.email.description',
            'config' => [
                'type' => 'email',
                'default' => '',
            ],
        ],


         'number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.number',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.number.description',
            'config' => [
                'type' => 'number',
                'default' => '',
            ],
        ],



        


        'course' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.course',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_students.course.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_nscourses_domain_model_course',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];
