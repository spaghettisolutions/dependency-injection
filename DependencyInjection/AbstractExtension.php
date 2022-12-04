<?php declare(strict_types = 1);

namespace Spaghetti\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Vairogs\Functions\Iteration;

abstract class AbstractExtension extends Extension
{
    use Traits\DependecyLoader;

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->init();
        $this->process(configs: $configs, container: $container, configuration: $configuration);
        $this->configure(container: $container, configuration: $configuration);
    }

    public function process(array $configs, ContainerBuilder $container, ConfigurationInterface $configuration): void
    {
        foreach ((new Iteration())->makeOneDimension(array: [$this->getAlias() => $this->processConfiguration(configuration: $configuration, configs: $configs)]) as $key => $value) {
            $container->setParameter(name: $key, value: $value);
        }
    }

    abstract protected function init(): ConfigurationInterface;

    abstract protected function configure(ContainerBuilder $container, ConfigurationInterface $configuration): void;
}
