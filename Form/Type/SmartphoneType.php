<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Ekyna\Bundle\ProductBundle\Form\Type\AbstractProductType;

/**
 * SmartphoneType
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneType extends AbstractProductType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->add('category', 'ekyna_resource', array(
                'label' => 'ekyna_core.field.category',
                'class' => 'Ekyna\Bundle\DemoBundle\Entity\Category',
                'property' => 'name',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.category',
                'attr' => array(
                    'placeholder' => 'ekyna_core.field.category',
                ),
            ))
            ->add('brand', 'ekyna_resource', array(
                'label' => 'ekyna_core.field.brand',
                'class' => 'Ekyna\Bundle\DemoBundle\Entity\Brand',
                'property' => 'title',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.brand',
                'attr' => array(
                    'placeholder' => 'ekyna_core.field.brand',
                ),
            ))
            ->add('html', 'textarea', array(
                'label' => 'ekyna_core.field.content',
                'attr' => array(
            	    'class' => 'tinymce',
                    'data-theme' => 'advanced',
                )
            ))
            ->add('releasedAt', 'datetime', array(
                'label' => 'Released At',
            ))
            ->add('tags', 'ekyna_resource', array(
                'label' => 'ekyna_core.field.tags',
                'class' => 'Ekyna\Bundle\DemoBundle\Entity\Tag',
                'multiple' => true,
                'property' => 'name',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.tags',
                'attr' => array(
            	    'placeholder' => 'ekyna_core.field.tags',
                ),
            ))
            ->add('images', 'collection', array(
                'label'        => 'ekyna_core.field.images',
                'type'         => 'ekyna_core_gallery_image',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options'      => array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'widget_col' => 12
                    ),
                    'image_path' => 'path',
                    'data_class' => 'Ekyna\Bundle\DemoBundle\Entity\SmartphoneImage',
                )
            ))
            ->add('characteristics', 'ekyna_characteristics')
            ->add('seo', 'ekyna_cms_seo', array(
                'label' => false
            ))
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
