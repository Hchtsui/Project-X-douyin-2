<?php
// src/Repository/TagsRepository.php

namespace App\Repository;

use App\Entity\Tags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
* @extends ServiceEntityRepository<Tags>
    */
    class TagsRepository extends ServiceEntityRepository
    {
    public function __construct(ManagerRegistry $registry)
    {
    parent::__construct($registry, Tags::class);
    }

    // Add custom methods here if needed
    }
