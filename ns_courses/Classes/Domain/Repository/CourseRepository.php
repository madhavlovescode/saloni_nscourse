<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Domain\Repository;
use Doctrine\DBAL\ParameterType;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * This file is part of the "Accesstive Administration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025
 */

/**
 * The repository for Courses
 */
class CourseRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{


   public function updateSysFileReferenceRecord(
    int $uid_local,
    int $uid_foreign,
    int $pid,
    string $table,
    string $field
): void {
    $tableConnectionCategoryMM = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable('sys_file_reference');

    $sysFileReferenceData[$uid_local] = [
        'uid_local' => $uid_local,
        'uid_foreign' => $uid_foreign,
        'tablenames' => $table,
        'fieldname' => $field,
        'sorting_foreign' => 1,
        'pid' => $pid,
        // 'table_local' removed — no longer used
    ];

    if (!empty($sysFileReferenceData)) {
        $tableConnectionCategoryMM->bulkInsert(
            'sys_file_reference',
            array_values($sysFileReferenceData),
            // Remove 'table_local' from here
            ['uid_local', 'uid_foreign', 'tablenames', 'fieldname', 'sorting_foreign', 'pid']
        );
    }

    $count = $this->getRefrenceImageCounts($uid_local, $uid_foreign, $field, $table);

    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
    $queryBuilder
        ->update($table)
        ->where(
            $queryBuilder->expr()->eq(
                'uid',
                $queryBuilder->createNamedParameter($uid_foreign, ParameterType::INTEGER)
            )
        )
        ->set($field, $count)
       ->executeStatement();
       // now exectu is not working so executestatemant 
}



    public function getRefrenceImageCounts($ref, $uid_foreign, $field, $table)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_file_reference');
        $lastRecord = $queryBuilder
            ->select('*')
            ->from('sys_file_reference')
            ->where(
                $queryBuilder->expr()->eq('uid_foreign', $queryBuilder->createNamedParameter($uid_foreign, ParameterType::INTEGER)),
                $queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter($table)),
                $queryBuilder->expr()->eq('fieldname', $queryBuilder->createNamedParameter($field)),
                $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, ParameterType::INTEGER)),
            )
           ->executeQuery()
            ->fetchAllAssociative();
        return count($lastRecord);
    }
    public function getRecord($uid)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_file_reference');
        $row = $queryBuilder
            ->select('*')
            ->from('tx_nscourses_domain_model_course')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, ParameterType::INTEGER)),
            )
          ->executeQuery()
            ->fetchAllAssociative();
        return count($row);
    }

}
//DO::PARAM_INT  it is not used instead of that ParameterType::INTEGER)),