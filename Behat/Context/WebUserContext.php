<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\NewsBundle\Behat\Context;

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
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
     * @When /^I open "([^"]*)" page$/
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
     * @Then /^I should see (\d+) news at list$/
     */
    public function iShouldSeeNewsAtList($newsCount)
    {
        expect($this->getPage('News Archive')->getNewsCount())->toBe((int) $newsCount);
    }

    /**
     * @Given /^I should see pagination with following buttons$/
     */
    public function iShouldSeePaginationWithFollowingButtons(TableNode $buttons)
    {
        $page = $this->getPage('News Archive');
        expect($page->hasPagination())->toBe(true);

        foreach ($buttons->getHash() as $buttonData) {
            expect($page->hasPaginationButton($buttonData['Button']))->toBe(true);
            expect($page->isButtonDisabled($buttonData['Button']))
                ->toBe($buttonData['Disabled'] == 'true');
            expect($page->isButtonCurrent($buttonData['Button']))
                ->toBe($buttonData['Current'] == 'true');
        }
    }

    /**
     * @Given /^I press pagination "([^"]*)" button$/
     */
    public function iPressPaginationButton($button)
    {
        $this->getPage('News Archive')->pressPaginationButton($button);
    }

    /**
     * @When /^I follow "([^"]*)" link from first news$/
     */
    public function iFollowLinkFromFirstNews($link)
    {
        $this->getPage('Homepage')->getFirstNews()->clickLink($link);
    }

    /**
     * @Then /^I should see news content$/
     */
    public function iShouldSeeNewsContent()
    {
        $newsContent = $this->getPage('News')->getNewsContent();
        expect($this->getDataContext()->findFirstLatestNews()->getContent())->toBe($newsContent->getText());
    }

    /**
     * @return DataContext
     */
    private function getDataContext()
    {
        return $this->getMainContext()->getSubcontext('data');
    }
}