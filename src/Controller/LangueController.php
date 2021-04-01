<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LangueController extends AbstractController
{
    /**
     * @Route("/langue/{langue}", name="langue")
     */
    public function index(Request $request, $langue): Response
    {      
        $request->getSession()->set('_locale',$langue);
        return $this->redirect($request->headers->get('referer'));
    }
}
