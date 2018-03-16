<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Type;
use App\Entity\Property;
use App\Entity\Thing;
use App\Entity\ThingValue;

class AppPopulateCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:populate';

    protected function configure()
    {
        $this
            ->setDescription('Fill in some rows in the database tables for testing purposes')
            ->addArgument('amount', InputArgument::OPTIONAL, 'Number of instances to insert', 10)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $amount = $input->getArgument('amount');

        /**
         * @var \Doctrine\Common\Persistence\ManagerRegistry $doctrine
         */
        $doctrine = $this->getContainer()->get("doctrine");
        
        $typeMgr = $doctrine->getManagerForClass(Type::class);
        $propertyMgr = $doctrine->getManagerForClass(Property::class);
        $thingMgr = $doctrine->getManagerForClass(Thing::class);
        $thingValueMgr = $doctrine->getManagerForClass(ThingValue::class);
        
        for($i = 1; $i <= $amount; $i++){
            $type = new Type();
            
            $type->setName("Type nr {$i}");
            
            $properties = [];
            for($j = 1; $j <= $amount; $j++){
                $property = new Property();
                
                $property->setType($type);
                $property->setName("{$type->getName()}'s #{$j} prop");
                $property->setSortnum($j);
                $property->setDefaultValue("default of Type{$i}:Prop{$j}");
                
                $propertyMgr->persist($property);
                
                $properties[] = $property;
            }
            
            $things = [];
            for($j = 1; $j <= $amount; $j++){
                $thing = new Thing();
                
                $thingValues = [];
                foreach($properties as $property){
                    $thingValue = new ThingValue();
                    
                    $thingValue->setProperty($property);
                    $thingValue->setThing($thing);
                    $thingValue->setValue($type->getName()."#{$i}'s ".$property->getName());
                    
                    $thingValueMgr->persist($thingValue);
                    
                    $thingValues[] = $thingValue;
                }
                
                $thing->setType($type);
                $thing->setThingValues($thingValues);
                
                $thingMgr->persist($thing);
                
                $things[] = $thing;
            }
            
            $type->setProperties($properties);
            $type->setThings($things);
            
            $typeMgr->persist($type);
        }
        
        $thingValueMgr->flush();
        $propertyMgr->flush();
        $thingMgr->flush();
        $typeMgr->flush();
        
        $io->success('OK probably');
    }
}
