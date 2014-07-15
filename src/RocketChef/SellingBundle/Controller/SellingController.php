<?php
/**
 * SellingController.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 13:25
 */

namespace RocketChef\SellingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SellingController extends Controller
{
    public function indexAction()
    {
        $sellingDays = $this->container->get('security.context')->getToken()->getUser()->getRestaurant()->getSellingDays();
        $paramsRender = array('sellingDays' => $sellingDays);
        return $this->render('RocketChefSellingBundle:Selling:list.html.twig', $paramsRender);
    }
} 