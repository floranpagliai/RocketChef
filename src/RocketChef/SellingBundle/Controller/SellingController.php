<?php
/**
 * SellingController.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 13:25
 */

namespace RocketChef\SellingBundle\Controller;

use RocketChef\DataBundle\Entity\SellingDay;
use RocketChef\DataBundle\Form\Type\SellingDayRecipeType;
use RocketChef\DataBundle\Form\Type\SellingDayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SellingController extends Controller
{
    public function indexAction()
    {
        $sellingDays = $this->container->get('security.context')->getToken()->getUser()->getRestaurant()->getSellingDays();
        $paramsRender = array('sellingDays' => $sellingDays);
        return $this->render('RocketChefSellingBundle:Selling:list.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $recipes = $this->get('rocketchef_data.recipe.provider')->getAllRestaurantMenuRecipes($restaurant->getId());

        $sellingDay = new SellingDay();
        $form = $this->createForm(new SellingDayType($this->container->get('security.context')), $sellingDay);


        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {

           }
        }
        $paramsRender = array('form' => $form->createView());
        return $this->render('@RocketChefSelling/Selling/add.html.twig', $paramsRender);
    }
} 