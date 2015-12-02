<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SmartphoneVariantType
 * @package Ekyna\Bundle\DemoBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneVariantType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characteristics', 'ekyna_characteristics')
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
