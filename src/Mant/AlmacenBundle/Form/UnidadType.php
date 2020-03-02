<?php

namespace Mant\AlmacenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UnidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('unidad')
            ->add('save', 'submit', array('label'=>'Guardar Unidad de Medida'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mant\AlmacenBundle\Entity\Unidad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mant_almacenbundle_unidad';
    }
}
