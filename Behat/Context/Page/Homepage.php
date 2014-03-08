<?php

namespace FSi\Bundle\NewsBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Homepage extends Page
{
    protected $path = '/';

    public function getLatestNewsTitles()
    {
        return array_map(
            function($node){
                return $node->find('css', 'div.title')->getText();
            },
            $this->findAll('css', 'div#latest-news > div.news')
        );
    }

    public function getFirstNews()
    {
        return $this->getElement('News');
    }
}