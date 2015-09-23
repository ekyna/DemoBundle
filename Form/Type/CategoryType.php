<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Ekyna\Bundle\MediaBundle\Model\MediaTypes;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\DemoBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'ekyna_core.field.name',
                'required' => true,
            ])
            ->add('color', 'ekyna_color_picker', [
                'label' => 'ekyna_core.field.color',
                'required' => true,
            ])
            ->add('parent', 'entity', [
                'label' => 'ekyna_core.field.parent',
                'class' => $this->dataClass,
                'empty_value' => 'ekyna_core.field.root',
                'query_builder' => function(EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('c')
                        ->orderBy('c.left', 'ASC')
                    ;
                },
                'property' => 'name',
                'required' => false,
            ])
            ->add('media', 'ekyna_media_choice', [
                'label' => 'ekyna_core.field.image',
                'required' => false,
                'types' => MediaTypes::IMAGE,
            ])
            ->add('seo', 'ekyna_cms_seo', [
                'label' => false
            ])
            ->add('html', 'tinymce', [
                'label' => 'ekyna_core.field.content',
                'theme' => 'advanced',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    	return 'ekyna_demo_category';
    }
}
