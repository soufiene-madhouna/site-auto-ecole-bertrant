<?php

namespace AgendaCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AgendaCBundle:Default:index.html.twig');
    }
}
