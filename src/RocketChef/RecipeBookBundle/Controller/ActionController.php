<?php
/**
 * ActionController.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 13:40
 */

namespace RocketChef\RecipeBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends Controller
{
    public function deleteAction(Request $request, $recipeId, $urlRedirect)
    {
        $restaurant = $this->getUser()->getRestaurant();
        $recipe = $this->getDoctrine()->getRepository('RocketChefDataBundle:Recipe')->find($recipeId);

        if ($recipe && $recipe->getRestaurant() == $restaurant) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recipe);
            $em->flush();
        }

        if ($urlRedirect == null)
            return $this->redirect($request->headers->get('referer'));
        else
            return $this->redirect($this->generateUrl($urlRedirect));
    }

    public function printAction($recipeId)
    {

    }

} 