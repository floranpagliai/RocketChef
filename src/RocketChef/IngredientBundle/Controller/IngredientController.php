<?php
/**
 * IngredientController.php
 * User: floran.pagliai
 * Date: 30/06/14
 * Time: 13:36
 */

namespace RocketChef\IngredientBundle\Controller;

use RocketChef\DataBundle\Entity\Ingredient;
use RocketChef\DataBundle\Form\Type\NewIngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IngredientController extends Controller
{
    public function indexAction()
    {
        $ingredients = $this->container->get('security.context')->getToken()->getUser()->getRestaurant()->getIngredients();
        $paramsRender = array('ingredients' => $ingredients);
        return $this->render('RocketChefIngredientBundle:ingredient:list.html.twig', $paramsRender);
    }

    public function showAction($ingredientId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $ingredient = $this->getDoctrine()->getRepository('RocketChefDataBundle:Ingredient')->find($ingredientId);
        if ($ingredient && $ingredient->getRestaurant() == $restaurant) {
            $paramsRender = array(
                'ingredient' => $ingredient,
            );
        } else
            throw $this->createNotFoundException('Ingredient introuvable');
        return $this->render('RocketChefIngredientBundle:ingredient:show.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $ingredient = new Ingredient();
        $form = $this->createForm(new NewIngredientType(), $ingredient);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $ingredient = $form->getData();
                $ingredient->setRestaurant($restaurant);
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();
                return $this->redirect($this->generateUrl('rocketchef_ingredient'));
            }
        }
        $paramsRender = array('form' => $form->createView());
        return $this->render('RocketChefIngredientBundle:ingredient:add.html.twig', $paramsRender);
    }

    public function editAction(Request $request, $ingredientId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();//TODO gestion du propriétaire
        $ingredientOld = $this->getDoctrine()->getRepository('RocketChefDataBundle:Ingredient')->find($ingredientId);
        $form = $this->createForm(new NewIngredientType(), $ingredientOld);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $ingredient = $form->getData();
                $ingredient->setRestaurant($restaurant);
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();
                return $this->redirect($this->generateUrl('rocketchef_ingredient'));
            }
        }
        $paramsRender = array('form' => $form->createView());
        return $this->render('RocketChefIngredientBundle:ingredient:edit.html.twig', $paramsRender);
    }
} 