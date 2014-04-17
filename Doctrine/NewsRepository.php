<?php

namespace FSi\Bundle\NewsBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use FSi\Bundle\NewsBundle\Model\NewsInterface;
use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;

class NewsRepository extends EntityRepository implements NewsRepositoryInterface
{
    /**
     * @param $count
     * @return NewsInterface[]
     */
    public function findLatestNews($count)
    {
        return $this->findBy(array(), array('date' => 'DESC'), (int) $count);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findNews($id)
    {
        return $this->findOneBy(array('id' => $id));
    }
}
