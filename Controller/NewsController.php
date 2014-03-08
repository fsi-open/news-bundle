<?php

namespace FSi\Bundle\NewsBundle\Controller;

use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @var \Pagerfanta\Pagerfanta
     */
    private $pager;

    /**
     * @param EngineInterface $templating
     * @param NewsRepositoryInterface $newsRepository
     * @param Pagerfanta $pager
     */
    public function __construct(EngineInterface $templating, NewsRepositoryInterface $newsRepository, Pagerfanta $pager)
    {
        $this->templating = $templating;
        $this->newsRepository = $newsRepository;
        $this->pager = $pager;
    }

    /**
     * @param int $count
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function latestNewsAction($count = 5)
    {
        return $this->templating->renderResponse(
            '@FSiNews/News/Partials/latestNews.html.twig',
            array(
                'latestNews' => $this->newsRepository->findLatestNews($count)
            )
        );
    }

    /**
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function archiveAction($page)
    {
        $this->pager->setCurrentPage($page);

        return $this->templating->renderResponse(
            '@FSiNews/News/archive.html.twig',
            array(
                'newsPager' => $this->pager
            )
        );
    }

    /**
     * @param int $id
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsAction($id)
    {
        $news = $this->newsRepository->findNews($id);

        if (!isset($news)) {
            throw new NotFoundHttpException();
        }

        return $this->templating->renderResponse(
            '@FSiNews/News/news.html.twig',
            array(
                'news' => $news
            )
        );
    }
}
