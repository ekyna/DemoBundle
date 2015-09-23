<?php

namespace Ekyna\Bundle\DemoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\DemoBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ekyna_admin.menu.pool')) {
            return;
        }

        $pool = $container->getDefinition('ekyna_admin.menu.pool');

        $pool->addMethodCall('createGroup', [[
            'name'     => 'catalog',
            'label'    => 'ekyna_demo.catalog',
            'icon'     => 'folder-open',
            'position' => 10,
        ]]);
        $pool->addMethodCall('createEntry', ['catalog', [
            'name'     => 'categories',
            'route'    => 'ekyna_demo_category_admin_home',
            'label'    => 'ekyna_demo.category.label.plural',
            'resource' => 'ekyna_demo_category',
            'position' => 98,
        ]]);
        $pool->addMethodCall('createEntry', ['catalog', [
            'name'     => 'smartphones',
            'route'    => 'ekyna_demo_smartphone_admin_home',
            'label'    => 'ekyna_demo.smartphone.label.plural',
            'resource' => 'ekyna_demo_smartphone',
        ]]);
        $pool->addMethodCall('createEntry', ['catalog', [
            'name'     => 'brands',
            'route'    => 'ekyna_demo_brand_admin_home',
            'label'    => 'ekyna_demo.brand.label.plural',
            'resource' => 'ekyna_demo_brand',
        ]]);
        $pool->addMethodCall('createEntry', ['catalog', [
            'name'     => 'stores',
            'route'    => 'ekyna_demo_store_admin_home',
            'label'    => 'ekyna_demo.store.label.plural',
            'resource' => 'ekyna_demo_store',
        ]]);
    }
}
