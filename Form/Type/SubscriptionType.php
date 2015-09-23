<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\ProductBundle\Form\Type\AbstractOptionType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * SubscriptionType.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SubscriptionType extends AbstractOptionType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('duration', 'integer', [
                'label' => 'ekyna_core.field.duration',
                'attr' => [
                    'label_col' => 4,
                    'widget_col' => 8,
                    'min' => 1,
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    	return 'ekyna_demo_subscription';
    }
}
