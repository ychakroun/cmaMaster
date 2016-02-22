<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CmaUserBundle\Entity\Image;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array('label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('name', HiddenType::class)
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $image = $event->getData();
                $form = $event->getForm();

                if (!$image) {
                    return;
                }
                if (is_array($image)) {
                    return;
                    if($image['file']===null){
                        unset($image['imageHeader']);
                    }else{
                       $image['name'] = $image['name'].'/'.$form->getParent()->getConfig()->getName();
                    }
                }else{
                    dump($image->file);
                    dump($image->name);
                }
                $event->setData($image);
            })
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Image',
            'csrf_protection' => false
        ));
    }
}
