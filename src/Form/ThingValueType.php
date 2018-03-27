<?php
namespace App\Form;

use App\Entity\ThingValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ThingValueType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', TextareaType::class, [
                "label" => false # ref. buildView
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ThingValue::class
        ]);
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        /**
         * @var ThingValue $property
         */
        $thingValue = $form->getData();
        
        $label = $thingValue->getProperty()->getName();
        
        $view->vars["label"] = $label;
    }
}
