<?php
/**
 * ActionController.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 13:40
 */

namespace Gastro\RecipeBookBundle\Controller;

use Gastro\DataBundle\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function deleteAction(Request $request, $recipeId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recipe);
            $em->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }
} 