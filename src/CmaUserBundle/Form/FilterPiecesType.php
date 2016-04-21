<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FilterPiecesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medium',ChoiceType::class , array(
                'choices' => $options['data']['data'],
                'choice_label' => function ($value) {
                return $value;
                },
                'multiple' => 'true',
                'expanded' => 'true',
                'label' => 'form.filterPieces.medium',
                'required' => false,
                'translation_domain' => 'FOSUserBundle'
            ))
            ->add('width',ChoiceType::class , array(
                'choices'=> array(
                    'petit',
                    'moyen',
                    'grand',
                    'très grand',
                ),
                'choice_label' => function ($value) {
                return $value;
                },
                'choices_as_values'=> true,
                'multiple' => 'true',
                'expanded' => 'true',
                'label' => 'form.filterPieces.width',
                'required' => false, 
                'translation_domain' => 'FOSUserBundle'
                ))
            ->add('price',ChoiceType::class , array(
                'choices' => array(
                    '<100'=>99,
                    '100-500'=>100,
                    '500-1000'=>500,
                    '2500>'=>2500,
                ),
                'multiple' => 'true',
                'expanded' => 'true',
                'label' => 'form.filterPieces.price',
                'required' => false,
                'translation_domain' => 'FOSUserBundle'
                ))
            ->setMethod('GET')
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'csrf_token_id'   => 'task_item',
        ));
    }
}
