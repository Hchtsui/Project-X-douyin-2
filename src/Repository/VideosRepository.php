<?php

/// src/Repository/VideosRepository.php

namespace App\Repository;

use App\Entity\Videos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

        if (!in_array('#All', $tagNames)) {
            $tagConditions = [];
            foreach ($tagNames as $index => $tagName) {
                $tagConditions[] = $qb->expr()->like('v.tag', ':tag' . $index);
                $qb->setParameter('tag' . $index, '%' . $tagName . '%');
            }
            $qb->andWhere(call_user_func_array([$qb->expr(), 'orX'], $tagConditions));
        }

        return $qb->getQuery()->getResult();
    }
}

