<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class SmartphoneVariantType
 * @package Ekyna\Bundle\DemoBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneVariantType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('id', 'number', [
                'sortable' => true,
            ])
            ->addColumn('name', 'anchor', [
                'label' => 'ekyna_core.field.name',
                //'sortable' => true,
                'route_name' => 'ekyna_demo_smartphone_variant_admin_show',
                'route_parameters_map' => [
                    'smartphoneId' => 'smartphone.id',
                    'smartphoneVariantId' => 'id',
                ],
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_smartphone_variant_admin_edit',
                        'route_parameters_map' => [
                            'smartphoneId' => 'smartphone.id',
                            'smartphoneVariantId' => 'id',
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_smartphone_variant_admin_remove',
                        'route_parameters_map' => [
                            'smartphoneId' => 'smartphone.id',
                            'smartphoneVariantId' => 'id',
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
//            ->addFilter('id', 'number')
//            ->addFilter('name', 'text', array(
//            	'label' => 'ekyna_core.field.name'
//            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_smartphone_variant';
    }
}
