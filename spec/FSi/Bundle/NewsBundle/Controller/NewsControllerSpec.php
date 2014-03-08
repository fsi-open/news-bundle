<?php

namespace spec\FSi\Bundle\NewsBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FSi\Bundle\NewsBundle\Model\NewsRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class NewsControllerSpec extends ObjectBehavior
{
    const LATEST_NEWS_COUNT = 5;

    function let(EngineInterface $templating, NewsRepositoryInterface $newsRepository)
    {
        $this->beConstructedWith($templating, $newsRepository);
    }

    function it_display_5_latest_news(EngineInterface $templating, NewsRepositoryInterface $newsRepository)
    {
        $newsRepository->findLatestNews(self::LATEST_NEWS_COUNT)->willReturn(new ArrayCollection(array()));
        $templating->renderResponse(
            '@FSiNews/News/Partials/latestNews.html.twig',
            Argument::withKey('latestNews')
        );

        $this->latestNewsAction(self::LATEST_NEWS_COUNT);
    }
}
