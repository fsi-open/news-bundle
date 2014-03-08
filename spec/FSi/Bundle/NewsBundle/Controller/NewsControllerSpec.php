<?php

namespace spec\FSi\Bundle\NewsBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;
use Pagerfanta\Pagerfanta;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class NewsControllerSpec extends ObjectBehavior
{
    const LATEST_NEWS_COUNT = 5;

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
        $pager->setCurrentPage(1)->shouldBeCalled();
        $templating->renderResponse(
            '@FSiNews/News/archive.html.twig',
            Argument::allOf(
                Argument::withEntry('newsPager', Argument::type('Pagerfanta\Pagerfanta'))
            )
        )->willReturn($response);

        $this->archiveAction(1)->shouldReturn($response);
    }
}
