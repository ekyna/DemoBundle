<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class StoreType
 * @package Ekyna\Bundle\DemoBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class StoreType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('name', 'anchor', [
                'label' => 'ekyna_core.field.name',
                'route_name' => 'ekyna_demo_store_admin_show',
                'route_parameters_map' => [
                    'storeId' => 'id'
                ],
            ])
            ->addColumn('country', 'country', [
                'label' => 'ekyna_core.field.country',
            ])
            /*->addColumn('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
                'route_name' => 'ekyna_demo_store_admin_toggle',
                'route_parameters_map' => array(
                    'storeId' => 'id',
                ),
            ))*/
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_store_admin_edit',
                        'route_parameters_map' => [
                            'storeId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_store_admin_remove',
                        'route_parameters_map' => [
                            'storeId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
            ->addFilter('name', 'text', [
                'label' => 'ekyna_core.field.name',
            ])
            ->addFilter('country', 'country', [
                'label' => 'ekyna_core.field.country',
            ])
            ->addFilter('enabled', 'boolean', [
                'label' => 'ekyna_core.field.validated',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_store';
    }
}
