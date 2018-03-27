<?php

namespace App\Form;

use App\Entity\Thing;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\ThingValue;
use App\Repository\ThingValueRepository;
use Doctrine\ORM\EntityManager;

class ThingType extends AbstractType
{
    /**
     * @var ThingValueRepository
     */
    private $thingValueRepository;
    
    /**
     * 
     * @param Type[] $types
     */
    public function __construct(ThingValueRepository $thingValueRepository){
        $this->thingValueRepository = $thingValueRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var Thing $thing
         */
        $thing = $options["data"];
        
        $builder->add('type', EntityType::class, [
            "class" => Type::class,
            "choice_label" => "name",
            "disabled" => true,
        ]);
        
        $thingValues = $this->thingValueRepository->findByThing($thing);

        #foreach($thingValues as $thingValue){
            $builder
                ->add("thingValues", CollectionType::class, [
                    "entry_type" => ThingValueType::class,
                    "entry_options" => [
                        #"data" => $thingValues,
                    ],
                ])
            ;
        #}
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Thing::class,
        ]);
    }
}
