<?php

namespace FundingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use FundingBundle\Exception\NoPresenterException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class FundingExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->configurePrimeNumbersPresenter($config, $container);

        $container->compile();
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     * @throws NoPresenterException
     */
    private function configurePrimeNumbersPresenter(array $config, ContainerBuilder $container)
    {
        $service = sprintf('funding.prime_numbers_%s.presenter', $config['prime_numbers_presenter']);

        if (!$container->hasDefinition($service)) {
            throw new NoPresenterException(
                sprintf(
                    "Service %s does not exists in services configuration.",
                    $service
                )
            );
        }

        $definition = new Definition(
            new Reference($service),
            [new Reference('funding.prime_numbers_calculator')]
        );

        $container->setDefinition('funding.prime_numbers.presenter', $definition);
    }
}
