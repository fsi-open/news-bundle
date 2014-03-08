<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FSi\Bundle\NewsBundle\FSiNewsBundle(),
            new FSi\FixturesBundle\FSiFixturesBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(sprintf('%s/config/config.yml', __DIR__));
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/FSiNewsBundle/cache';
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/FSiNewsBundle/logs';
    }
}