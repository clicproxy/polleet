<?php

namespace Clicproxy\PolleetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PollType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug')
            ->add('question')
            ->add('end')
            ->add('countdown')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Clicproxy\PolleetBundle\Entity\Poll'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clicproxy_polleetbundle_poll';
    }
}
