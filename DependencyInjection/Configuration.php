<?php

declare(strict_types=1);

namespace Neo\Bundle\TodoBundle\DependencyInjection;

use Neo\Bundle\TodoBundle\Entity\TodoEntityInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('neo_todo');

        $rootNode
            ->children()
                ->scalarNode('entity_name')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->validate()
                        ->always($this->validationForInstanceOfClass(TodoEntityInterface::class, 'entity_name'))
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * @param string $subclassName
     * @param string $fieldName
     *
     * @return \Closure
     */
    private function validationForInstanceOfClass(string $subclassName, string $fieldName): \Closure
    {
        return function ($className) use ($subclassName, $fieldName) {
            if (!is_subclass_of($className, $subclassName)) {
                throw new InvalidConfigurationException(sprintf(
                    'Parameter "%s" should contain class which implements "%s"',
                    $fieldName,
                    $subclassName
                ));
            }

            return $className;
        };
    }
}
