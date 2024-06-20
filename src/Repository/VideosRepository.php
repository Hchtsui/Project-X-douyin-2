<?php
// src/Repository/VideosRepository.php

namespace App\Repository;

use App\Entity\Videos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Videos>
 */
class VideosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Videos::class);
    }

    /**
     * @param int $categoryId
     * @param array $tagNames
     * @return Videos[]
     */
    public function findByCategoryAndTags(int $categoryId, array $tagNames): array
    {
        $qb = $this->createQueryBuilder('v')
            ->innerJoin('v.categories', 'c')
            ->andWhere('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId);

        if ($tagNames[0] !== '#All') {
            $qb->innerJoin('v.tags', 't')
                ->andWhere('t.name IN (:tagNames)')
                ->setParameter('tagNames', $tagNames);
        }

        return $qb->getQuery()->getResult();
    }
}
