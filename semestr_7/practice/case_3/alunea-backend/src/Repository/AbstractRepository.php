<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    protected const DEFAULT_BATCH_SIZE = 1000;

    public function save(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function findAllGenerator(int $batchSize = self::DEFAULT_BATCH_SIZE): \Generator
    {
        $offset = 0;

        while (true) {
            $qb = $this->createQueryBuilder('p')
                ->orderBy('p.id', 'ASC')
                ->setFirstResult($offset)
                ->setMaxResults($batchSize);

            $results = $qb->getQuery()->getResult();

            if (count($results) === 0) {
                break;
            }

            foreach ($results as $entity) {
                yield $entity;
            }

            $offset += $batchSize;

            $this->getEntityManager()->clear();
        }
    }
}
