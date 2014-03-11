<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\NewsBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use FSi\Bundle\NewsBundle\DependencyInjection\FSINewsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FSiNewsBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver(
            $this->getDoctrineMappings(),
            array('doctrine.orm.entity_manager'))
        );
    }

    /**
     * @return FSINewsExtension
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FSINewsExtension();
        }

        return $this->extension;
    }

    /**
     * @return array
     */
    private function getDoctrineMappings()
    {
        return array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'FSi\Bundle\NewsBundle\Model',
        );
    }
}
