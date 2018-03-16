<?php

namespace App\Controller;

use App\Entity\Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TypeController extends Controller
{
    /**
     * @Route("/type", name="type_list")
     */
    public function list()
    {
        $types = $this->getDoctrine()
          ->getRepository(Type::class)
          ->findAll();

        return $this->render('type/list.html.twig', [
            'types' => $types,
        ]);
    }

    /**
     * @Route("/type/{id}", name="type_show")
     */
    public function show($id)
    {
        $type = $this->getDoctrine()->getRepository(Type::class)->find($id);

        return $this->render('type/show.html.twig', [
            'type' => $type,
            'things' => $type->getThings(),
            'properties' => $type->getProperties(),
        ]);
    }
}
