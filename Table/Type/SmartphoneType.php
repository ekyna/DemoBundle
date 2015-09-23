<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Sale\Product\ProductTypes;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class SmartphoneType
 * @package Ekyna\Bundle\DemoBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneType extends ResourceTableType
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
                'sortable' => true,
                'route_name' => 'ekyna_demo_smartphone_admin_show',
                'route_parameters_map' => [
                    'smartphoneId' => 'id'
                ],
            ])
            ->addColumn('category', 'anchor', [
                'label' => 'ekyna_core.field.category',
                'property_path' => 'category.name',
                'sortable' => false,
                'route_name' => 'ekyna_demo_category_admin_show',
                'route_parameters_map' => [
                    'categoryId' => 'category.id'
                ],
            ])
            ->addColumn('type', 'choice', [
                'label' => 'ekyna_core.field.type',
                'sortable' => false,
                'choices' => ProductTypes::getChoices(),
            ])
            ->addColumn('price', 'number', [
                'label' => 'ekyna_core.field.price',
                'sortable' => true,
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_smartphone_admin_edit',
                        'route_parameters_map' => [
                            'smartphoneId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_smartphone_admin_remove',
                        'route_parameters_map' => [
                            'smartphoneId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
            ->addFilter('id', 'number')
            ->addFilter('name', 'text', [
            	'label' => 'ekyna_core.field.name'
            ])
            ->addFilter('price', 'number', [
        	    'label' => 'ekyna_core.field.price'
            ])
            ->addFilter('type', 'choice', [
        	    'label' => 'ekyna_core.field.type',
                'choices' => ProductTypes::getChoices(),
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_smartphone';
    }
}
