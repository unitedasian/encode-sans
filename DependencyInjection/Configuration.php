<?php

namespace UAM\Font\EncodeSans\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * EncodeSans bundle extension.
 *
 * @author     Olivier Pichon <op@united-asian.com>
 * @copyright  2016 Olivier Pichon
 */
class Configuration implements ConfigurationInterface
{
    const MODE_FAMILIES = 'families';

    const MODE_INDIVIDUAL = 'individual';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('encode_sans');

        $rootNode
            ->children()
                ->enumNode('mode')
                    ->values(array(self::MODE_FAMILIES, self::MODE_INDIVIDUAL))
                    ->defaultValue(self::MODE_INDIVIDUAL)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
