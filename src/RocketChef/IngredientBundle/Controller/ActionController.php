<?php
/**
 * ActionController.php
 * User: floran.pagliai
 * Date: 30/06/14
 * Time: 15:46
 */

namespace RocketChef\IngredientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function deleteAction(Request $request, $ingredientId, $urlRedirect)
    {
        $restaurant = $this->getUser()->getRestaurant();
        $ingredient = $this->getDoctrine()->getRepository('RocketChefDataBundle:Ingredient')->find($ingredientId);

        if ($ingredient && $ingredient->getRestaurant() == $restaurant) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ingredient);
            $em->flush();
            $flash = $this->get('notify_messenger.flash');
            $flash->info('Ingredient deleted.');
        }

        if ($urlRedirect === null)
            return $this->redirect($request->headers->get('referer'));
        else
            return $this->redirect($this->generateUrl($urlRedirect));
    }
} 