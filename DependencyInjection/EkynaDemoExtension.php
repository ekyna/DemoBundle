<?php

namespace Ekyna\Bundle\DemoBundle\DependencyInjection;

use Ekyna\Bundle\AdminBundle\DependencyInjection\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * EkynaDemoExtension
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaDemoExtension extends AbstractExtension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->configure($configs, 'ekyna_demo', new Configuration(), $container);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        $config = array(
            'bundles' => array('EkynaDemoBundle')
        );
        if (true === isset($bundles['AsseticBundle'])) {
            $this->configureAsseticBundle($container, $config);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     *
     * @return void
     */
    protected function configureAsseticBundle(ContainerBuilder $container, array $config)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            if ($name == 'assetic') {
                $container->prependExtensionConfig($name, $config);
                break;
            }
        }
    }
}
