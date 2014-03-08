<?php

namespace FSi\Bundle\NewsBundle\Controller;

use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class NewsController
{
    /**
     * @var EngineInterface
     */
    private $templating;
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @param EngineInterface $templating
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(EngineInterface $templating, NewsRepositoryInterface $newsRepository)
    {
        $this->templating = $templating;
        $this->newsRepository = $newsRepository;
    }

    public function latestNewsAction($count = 5)
    {
        return $this->templating->renderResponse(
            '@FSiNews/News/Partials/latestNews.html.twig',
            array(
                'latestNews' => $this->newsRepository->findLatestNews($count)
            )
        );
    }
}
