<?php
/**
 * IngredientController.php
 * User: floran.pagliai
 * Date: 30/06/14
 * Time: 13:36
 */

namespace RocketChef\IngredientBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    public function indexAction()
    {
        $paramsRender = array();

        return $this->render('RocketChefIngredientBundle:ingredient:list.html.twig', $paramsRender);
    }
} 