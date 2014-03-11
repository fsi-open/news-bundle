<?php

namespace FSi\Bundle\NewsBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class NewsArchive extends Page
{
    protected $path = '/news/archive';

    /**
     * @return int
     */
    public function getNewsCount()
    {
        return count($this->findAll('css', 'div#news-archive > div.news'));
    }

    /**
     * @return bool
     */
    public function hasPagination()
    {
        return $this->has('css', 'div.pagination > nav');
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function hasPaginationButton($text)
    {
        return $this->hasLink($text) || $this->has('css', sprintf('span:contains("%s")', $text));
    }

    /**
     * @param $text
     */
    public function pressPaginationButton($text)
    {
        return $this->clickLink($text);
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function isButtonDisabled($text)
    {
        $button = $this->findLink($text);
        if (!isset($button)) {
            $button = $this->find('css', sprintf('span:contains("%s")', $text));
        }
        return $button->hasClass('disabled');
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function isButtonCurrent($text)
    {
        $button = $this->findLink($text);
        if (!isset($button)) {
            $button = $this->find('css', sprintf('span:contains("%s")', $text));
        }

        return $button->hasClass('current');
    }
}