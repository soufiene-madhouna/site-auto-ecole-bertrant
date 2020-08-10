<?php

namespace TransporteursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TransporteursBundle:Default:index.html.twig');
    }
}
