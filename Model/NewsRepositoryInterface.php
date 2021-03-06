<?php

namespace FSi\Bundle\NewsBundle\Model;

interface NewsRepositoryInterface
{
    /**
     * @param $count
     * @return NewsInterface[]
     */
    public function findLatestNews($count);

    /**
     * @param int $id
     * @return mixed
     */
    public function findNews($id);
}