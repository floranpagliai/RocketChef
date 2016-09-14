<?php
/**
 * SellingController.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 13:25
 */

namespace RocketChef\SellingBundle\Controller;

use RocketChef\DataBundle\Form\Type\SellingDayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SellingController extends Controller
{
    public function indexAction()
    {
        $sellingDays = $this->getUser()->getRestaurant()->getSellingDays();
        $paramsRender = array('sellingDays' => $sellingDays);
        return $this->render('RocketChefSellingBundle:Selling:list.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $restaurant = $this->getUser()->getRestaurant();

        $form = $this->createForm(new SellingDayType($this->container->get('security.context')));
        $form->handleRequest($request);
            if ($form->isValid()) {
                $sellingDay = $form->getData();
                $sellingDay->setRestaurant($restaurant);

                $sellingDay = $this->get('rocket_chef_selling')->calculateSellingDay($sellingDay);
                $em = $this->getDoctrine()->getManager();
                $em->persist($sellingDay);
                $em->flush();
                return $this->redirect($this->generateUrl('rocketchef_selling'));
           }

        $paramsRender = array('form' => $form->createView());
        return $this->render('@RocketChefSelling/Selling/add.html.twig', $paramsRender);
    }
} 