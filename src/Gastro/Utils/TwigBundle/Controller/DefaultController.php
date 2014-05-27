<?php

namespace Gastro\Utils\TwigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GastroUtilsTwigBundle:Default:index.html.twig', array('name' => $name));
    }
}
