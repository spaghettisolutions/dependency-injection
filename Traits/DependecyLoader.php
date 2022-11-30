<?php declare(strict_types = 1);

namespace SimpleToImplement\DependencyInjection\Traits;

use SimpleToImplement\DependencyInjection\Dependency;
use SimpleToImplement\DependencyInjection\Functions;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait DependecyLoader
{
    protected function appendComponent(string $class, ArrayNodeDefinition $arrayNodeDefinition): void
    {
        if ($this->checkImplementation(class: $class)) {
            (new $class())->getConfiguration(arrayNodeDefinition: $arrayNodeDefinition);
        }
    }

    protected function configureComponent(string $class, ContainerBuilder $container, ConfigurationInterface $configuration): void
    {
        if ($this->checkImplementation(class: $class)) {
            (new $class())->loadComponent(container: $container, configuration: $configuration);
        }
    }

    protected function checkImplementation(string $class): bool
    {
        return (new Functions())->classImplements(class: $class, interface: Dependency::class);
    }
}
