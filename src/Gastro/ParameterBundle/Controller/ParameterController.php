<?php
/**
 * ParameterController.php
 * User: Utilisateur
 * Date: 11/06/14
 * Time: 11:38
 */

namespace Gastro\ParameterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParameterController extends Controller
{
    public function indexAction()
    {
        return $this->render('GastroParameterBundle:parameter:parameter.html.twig');
    }
}
