<?php declare(strict_types = 1);

namespace Spaghetti\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

interface Dependency
{
    public function getConfiguration(ArrayNodeDefinition $arrayNodeDefinition): void;

    public function loadComponent(ContainerBuilder $container, ConfigurationInterface $configuration): void;
}
