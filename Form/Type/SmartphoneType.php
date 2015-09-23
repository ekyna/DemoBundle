<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\MediaBundle\Model\MediaTypes;
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
            ->add('name', 'text', [
                'label' => 'ekyna_core.field.name',
            ])
            ->add('category', 'ekyna_resource', [
                'label' => 'ekyna_core.field.category',
                'class' => 'Ekyna\Bundle\DemoBundle\Entity\Category',
                'property' => 'name',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.category',
                'attr' => [
                    'placeholder' => 'ekyna_core.field.category',
                ],
            ])
            ->add('brand', 'ekyna_resource', [
                'label' => 'ekyna_core.field.brand',
                'class' => 'Ekyna\Bundle\DemoBundle\Entity\Brand',
                'property' => 'title',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.brand',
                'attr' => [
                    'placeholder' => 'ekyna_core.field.brand',
                ],
            ])
            ->add('html', 'tinymce', [
                'label' => 'ekyna_core.field.content',
                'theme' => 'advanced',
            ])
            ->add('releasedAt', 'datetime', [
                'label' => 'Released At',
            ])
            ->add('tags', 'ekyna_cms_tags')
            ->add('characteristics', 'ekyna_characteristics')
            ->add('images', 'ekyna_media_collection', [
                'label' => 'ekyna_core.field.images',
                'media_class' => 'Ekyna\Bundle\DemoBundle\Entity\SmartphoneImage',
                'types' => [MediaTypes::IMAGE],
            ])
            ->add('document', 'ekyna_media_choice', [
                'label' => 'ekyna_core.field.document',
                'types' => [MediaTypes::FILE],
            ])
            ->add('seo', 'ekyna_cms_seo', [
                'label' => false
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
