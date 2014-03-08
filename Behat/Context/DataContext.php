<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\NewsBundle\Behat\Context;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Faker\ORM\Doctrine\Populator;
use Symfony\Component\HttpKernel\KernelInterface;

class DataContext extends BehatContext implements KernelAwareInterface
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
     * @BeforeScenario
     */
    public function createDatabase()
    {
        $this->deleteDatabaseIfExist();
        $metadata = $this->getDoctrine()->getManager()->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool($this->getDoctrine()->getManager());
        $tool->createSchema($metadata);
    }

    /**
     * @AfterScenario
     */
    public function deleteDatabaseIfExist()
    {
        $dbFilePath = $this->kernel->getRootDir() . '/data.sqlite';

        if (file_exists($dbFilePath)) {
            unlink($dbFilePath);
        }
    }

    /**
     * @Given /^There are (\d+) news in database$/
     */
    public function thereAreNewsInDatabase($newsCount)
    {
        $faker = \Faker\Factory::create();
        $populator = new Populator($faker, $this->getDoctrine()->getManager());
        $populator->addEntity(
            'FSi\FixturesBundle\Entity\News',
            (int) $newsCount,
            array(
                'date' => function() use ($faker) { return $faker->dateTimeThisYear(); }
            )
        );
        $populator->execute();
    }

    /**
     * @return \FSi\FixturesBundle\Entity\News[]
     */
    public function getLatestNews()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('FSi\FixturesBundle\Entity\News')
            ->findBy(array(), array('date' => 'ASC'));
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine()
    {
        return $this->kernel->getContainer()->get('doctrine');
    }
}