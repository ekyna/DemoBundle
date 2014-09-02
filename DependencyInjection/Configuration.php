<?php

namespace Ekyna\Bundle\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Configuration
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ekyna_demo');

        $this->addPoolsSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds admin pool sections.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addPoolsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pools')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('category')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('templates')->defaultValue('EkynaDemoBundle:Category/Admin')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Category')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\DemoBundle\Controller\Admin\CategoryController')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\CategoryRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\CategoryType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\CategoryType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('brand')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('templates')->defaultValue('EkynaDemoBundle:Brand/Admin')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Brand')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\BrandType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\BrandType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('tag')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('templates')->defaultValue('EkynaDemoBundle:Tag/Admin')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Tag')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\TagType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\TagType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('smartphone')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('templates')->defaultValue('EkynaDemoBundle:Smartphone/Admin')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Smartphone')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\DemoBundle\Controller\Admin\SmartphoneController')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\SmartphoneType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\SmartphoneType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('smartphoneVariant')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('templates')->defaultValue('EkynaDemoBundle:SmartphoneVariant/Admin')->end()
                                ->scalarNode('parent')->defaultValue('ekyna_demo.smartphone')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\SmartphoneVariantType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\SmartphoneVariantType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
