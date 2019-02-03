<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findLatestArticles()
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.tutorial = FALSE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findLatestTutorials()
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.tutorial = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findArticles($offset)
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.blog = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(20)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    public function findTutorials($offset)
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.tutorial = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(20)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    public function findAllArticles()
    {
        return $this->createQueryBuilder('article')
            ->orderBy('article.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
