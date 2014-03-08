<?php

namespace FSi\Bundle\NewsBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class News extends Page
{
    public function getNewsContent()
    {
        return $this->find('css', 'div.content');
    }
}