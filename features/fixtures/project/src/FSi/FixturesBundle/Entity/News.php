<?php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\NewsBundle\Model\News as BaseNews;

/**
 * @ORM\Entity(repositoryClass="FSi\Bundle\NewsBundle\Doctrine\NewsRepository")
 * @ORM\Table(name="fsi_news")
 */
class News extends BaseNews
{
}