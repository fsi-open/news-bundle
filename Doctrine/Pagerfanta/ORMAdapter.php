<?php

namespace FSi\Bundle\NewsBundle\Doctrine\Pagerfanta;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class ORMAdapter extends DoctrineORMAdapter
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository->createQueryBuilder('news')->orderBy('news.date', 'DESC'));
    }
}
