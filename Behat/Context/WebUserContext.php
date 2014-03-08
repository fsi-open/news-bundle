<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\NewsBundle\Behat\Context;

use Behat\Behat\Exception\PendingException;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use Symfony\Component\HttpKernel\KernelInterface;

class WebUserContext extends PageObjectContext implements KernelAwareInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel HttpKernel instance
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I am on the "([^"]*)" page$/
     */
    public function iAmOnThePage($pageName)
    {
        $this->getPage($pageName)->open();
    }

    /**
     * @Then /^I should see latest news$/
     */
    public function iShouldSeeLatestNews()
    {
        $titles = $this->getPage('Homepage')->getLatestNewsTitles();
        $news = $this->getDataContext()->getLatestNews();
        expect(count($titles))->toBe(count($news));
        expect(array_map(function($newsEntity) { return $newsEntity->getTitle();}, $news))->toBe($titles);
    }

    /**
     * @return DataContext
     */
    private function getDataContext()
    {
        return $this->getMainContext()->getSubcontext('data');
    }
}