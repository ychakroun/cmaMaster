<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProposalEtatType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                switch ($data->getPiece()->getEtat()) {
                    case 1:
                       $form ->add('etat',SubmitType::class,array(
                         'label'=>'form.proposal.etat.1',
                         'translation_domain'=>'FOSUserBundle',
                          'attr'=> array('class' => 'js-alert-popup'),
                       ));
                      break;
                    case 2:
                       $form->add('etat',SubmitType::class,array('label'=>'form.proposal.etat.2','translation_domain'=>'FOSUserBundle'));
                      break;
                    case 3:
                       $form->add('etat',SubmitType::class,array('label'=>'form.proposal.etat.3','translation_domain'=>'FOSUserBundle'));
                      break;
                    case 4:
                       $form->add('etat',SubmitType::class,array('label'=>'form.proposal.etat.4','translation_domain'=>'FOSUserBundle'));
                      break;
                    default:
                        $form ->add('etat',SubmitType::class,array(
                          'label'=>'form.proposal.etat.1',
                        'translation_domain'=>'FOSUserBundle',
                         'attr'=> array('class' => 'js-alert-popup'),
                      ));
                      break;
                    }
            });
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
