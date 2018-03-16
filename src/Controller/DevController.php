<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevController extends Controller
{
    /**
     * @Route("/dev", name="dev")
     */
    public function index()
    {
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }
    
    /**
     * @Route("/dev/repopulate", name="dev_db_repopulate")
     */
    public function repopulate(){
        #$this->getDoctrine()->
    }
}
