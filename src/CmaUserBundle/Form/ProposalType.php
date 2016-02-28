<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use CmaUserBundle\Form\PieceProposalType;

class ProposalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',null,array('label' => 'form.estimate.description',
                'required' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'desc',
                    'cols'=>'40',
                    'rows'=>'8')
                ))
            ->add('day', NumberType::class,array('label' => 'form.estimate.day',
                'required' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'jours',
                    'type'=>'number')
                ))
            ->add('piece',PieceProposalType::class,array('label' => false,
                'required' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'piece')
                ))
            ->add('condition', CheckboxType::class,array("mapped" => false,
                'required' => true,
                'label' => 'form.estimate.condition',
                'translation_domain' => 'FOSUserBundle'
                ))
            
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Proposal'
        ));
    }
}
