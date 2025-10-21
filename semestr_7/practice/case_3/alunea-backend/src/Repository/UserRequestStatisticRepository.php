<?php

namespace App\Repository;

use App\Entity\UserRequestStatistic;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserRequestStatistic>
 */
class UserRequestStatisticRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRequestStatistic::class);
    }

    public function incrementRequestCount(
        string $userId,
        \DateTimeImmutable $date,
        string $type,
        int $incrementBy = 1
    ): void {
        $this->getEntityManager()->getConnection()->executeStatement(
            '
            INSERT INTO user_request_statistic (id, user_id, date, type, count)
            VALUES (UUID(), :user_id, :date, :type, :count)
            ON DUPLICATE KEY UPDATE count = count + :count
            ',
            [
                'user_id' => $userId,
                'date' => $date->format('Y-m-d'),
                'type' => $type,
                'count' => $incrementBy,
            ]
        );
    }
}
