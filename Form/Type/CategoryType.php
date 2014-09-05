<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * CategoryType.
 *
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
            ->add('name', 'text', array(
                'label' => 'ekyna_core.field.name',
                'required' => true,
            ))
            ->add('parent', 'entity', array(
                'label' => 'ekyna_core.field.parent',
                'class' => $this->dataClass,
                'empty_value' => 'ekyna_core.field.root',
                'query_builder' => function(EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('p')
                        ->orderBy('p.left', 'ASC')
                    ;
                },
                'property' => 'name',
                'required' => false,
            ))
            ->add('image', 'ekyna_core_image', array(
                'label' => 'ekyna_core.field.image',
                'data_class' => 'Ekyna\Bundle\DemoBundle\Entity\CategoryImage',
                'required' => false,
                'alt_field' => false,
                'name_field' => false,
            ))
            ->add('seo', 'ekyna_cms_seo', array(
                'label' => false
            ))
            ->add('html', 'textarea', array(
                'label' => 'ekyna_core.field.content',
                'attr' => array(
            	    'class' => 'tinymce',
                    'data-theme' => 'advanced',
                )
            ))
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
