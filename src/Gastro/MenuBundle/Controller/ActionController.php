<?php
/**
 * ActionController.php
 * User: Utilisateur
 * Date: 06/06/14
 * Time: 12:21
 */

namespace Gastro\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends Controller
{
    public function addRecipeAction(Request $request, $recipeId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getRestaurant() == $restaurant) {
            $em = $this->getDoctrine()->getManager();

            $recipe->setIsInMenu(true);
            $em->persist($recipe);
            $em->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function removeRecipeAction(Request $request, $recipeId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getRestaurant() == $restaurant) {
            $em = $this->getDoctrine()->getManager();

            $recipe->setIsInMenu(false);
            $em->persist($recipe);
            $em->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }
} 