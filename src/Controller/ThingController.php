<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Thing;

class ThingController extends Controller
{
    /**
     * @Route("/thing", name="thing")
     */
    public function index()
    {
        return $this->render('thing/index.html.twig', [
            'controller_name' => 'ThingController',
        ]);
    }

    /**
     * @Route("/thing/{id}", name="thing_show")
     */
    public function show(Thing $thing)
    {
        $keyValuePairs = [];

        foreach ($thing->getType()->getProperties() as $property) {
            $keyValuePairs[$property->getName()] = [
                'key' => $property->getName(),
                'value' => $property->getDefaultValue(),
                'sortnum' => $property->getSortnum(),
                'defaulted' => true,
            ];
        }
        foreach ($thing->getThingValues() as $thingValue) {
            $keyValuePairs[$thingValue->getProperty()->getName()] = [
                'key' => $thingValue->getProperty()->getName(),
                'value' => $thingValue->getValue(),
                'sortnum' => $thingValue->getProperty()->getSortnum(),
                'defaulted' => false,
            ];
        }

        return $this->render('thing/show.html.twig', [
            'thing' => $thing,
            'keyValuePairs' => $keyValuePairs,
        ]);
    }
}
