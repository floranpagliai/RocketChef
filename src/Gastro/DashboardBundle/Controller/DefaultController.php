<?php

namespace Gastro\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GastroDashboardBundle:Default:index.html.twig', array('name' => 'floran'));
    }
}
