<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * BrandType.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BrandType extends AbstractType
{
    protected $dataClass;

    public function __construct($class)
    {
        $this->dataClass = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'ekyna_core.field.title',
                'required' => true,
            ))
            ->add('seo', 'ekyna_cms_seo', array(
                'label' => false
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->dataClass,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    	return 'ekyna_demo_brand';
    }
}
