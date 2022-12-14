<?php declare(strict_types = 1);

namespace Spaghetti\DependencyInjection\Traits;

use Spaghetti\DependencyInjection\Dependency;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vairogs\Functions\Php;

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
        return (new Php())->classImplements(class: $class, interface: Dependency::class);
    }
}
