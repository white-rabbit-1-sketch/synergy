<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DatabaseService
{
    public function __construct(
        protected ManagerRegistry $managerRegistry
    ) {}

    public function resetEntityManager(?string $name = null): EntityManagerInterface
    {
        /** @var EntityManagerInterface $manager */
        $manager = $this->managerRegistry->getManager($name);
        if (!$manager->isOpen()) {
            $this->managerRegistry->resetManager($name);
            $manager = $this->managerRegistry->getManager($name);
        }

        return $manager;
    }

    public function clearCache(?string $name = null): void
    {
        /** @var EntityManagerInterface $manager */
        $manager = $this->managerRegistry->getManager($name);
        $manager->clear();
    }
}