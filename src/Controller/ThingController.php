<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Thing;
use App\Entity\Type;

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
    	$entityManager = $this->getDoctrine()->getManager();
    	$typeRepository = $entityManager->getRepository(Type::class);
    	$type = $typeRepository->find($thing->getId());

    	$properties = [];

        return $this->render('thing/show.html.twig', [
            "thing" => $thing,
            "type" => $type,
            "properties" => $properties,
        ]);
    }

}
