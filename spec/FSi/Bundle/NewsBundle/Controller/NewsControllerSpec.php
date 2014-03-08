<?php

namespace spec\FSi\Bundle\NewsBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FSi\Bundle\NewsBundle\Model\NewsInterface;
use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;
use Pagerfanta\Pagerfanta;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsControllerSpec extends ObjectBehavior
{
    /* @var int */
    const LATEST_NEWS_COUNT = 5;

    /* @var int */
    const NEWS_ID = 1;

    /* @var int */
    const PAGE = 1;

    function let(EngineInterface $templating, NewsRepositoryInterface $newsRepository, Pagerfanta $pager)
    {
        $this->beConstructedWith($templating, $newsRepository, $pager);
    }

    function it_display_5_latest_news(EngineInterface $templating, NewsRepositoryInterface $newsRepository, Response $response)
    {
        $newsRepository->findLatestNews(self::LATEST_NEWS_COUNT)->willReturn(new ArrayCollection(array()));
        $templating->renderResponse(
            '@FSiNews/News/Partials/latestNews.html.twig',
            Argument::withKey('latestNews')
        )->willreturn($response);

        $this->latestNewsAction(self::LATEST_NEWS_COUNT)->shouldReturn($response);
    }

    function it_display_news_archive(EngineInterface $templating, Response $response, Pagerfanta $pager)
    {
        $pager->setCurrentPage(self::PAGE)->shouldBeCalled();
        $templating->renderResponse(
            '@FSiNews/News/archive.html.twig',
            Argument::allOf(
                Argument::withEntry('newsPager', Argument::type('Pagerfanta\Pagerfanta'))
            )
        )->willReturn($response);

        $this->archiveAction(self::PAGE)->shouldReturn($response);
    }

    function it_display_news(EngineInterface $templating, NewsRepositoryInterface $newsRepository, Response $response, NewsInterface $news)
    {
        $newsRepository->findNews(self::NEWS_ID)->willReturn($news);
        $templating->renderResponse(
            '@FSiNews/News/news.html.twig',
            array('news' => $news)
        )->willReturn($response);

        $this->newsAction(self::NEWS_ID)->shouldReturn($response);
    }

    function it_throw_not_found_exception_when_news_does_not_exist(NewsRepositoryInterface $newsRepository)
    {
        $newsRepository->findNews(self::NEWS_ID)->willReturn(null);
        $this->shouldThrow(new NotFoundHttpException())->duringNewsAction(self::NEWS_ID);
    }
}
