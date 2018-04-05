<?php

namespace App\Controller;

use App\Entity\Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\Request;

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
    public function show(Type $type)
    {
        return $this->render('type/show.html.twig', [
            'type' => $type,
            'things' => $type->getThings(),
            'properties' => $type->getProperties(),
        ]);
    }

    /**
     * @Route("/type/{id}/edit", name="type_edit")
     */
    public function edit(Type $type, Request $request)
    {
        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /**
             * @var Properties[]
             */
            $submittedProperties = $form->getData()->getProperties();
            foreach ($submittedProperties as $property) {
                $entityManager->persist($property);
            }
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('type_show', ['id' => $type->getId()]);
        }

        return $this->render('type/edit.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type/new", name="type_new")
     */
    public function new(Request $request)
    {
        $type = new Type();

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($type->getProperties() as $property) {
                $entityManager->persist($property);
            }
            $entityManager->persist($type);

            $entityManager->flush();

            return $this->redirectToRoute('type_list');
        }

        return $this->render('type/new.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }
}
