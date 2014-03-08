<?php

namespace FSi\Bundle\NewsBundle\Behat\Context\Page\Element;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class News extends Element
{
    /**
     * @var array $selector
     */
    protected $selector = array('css' => 'div.news');

    public function followReadMore()
    {
        $this->clickLink("Read more");
    }
}