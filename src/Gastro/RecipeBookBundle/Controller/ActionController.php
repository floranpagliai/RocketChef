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

class ActionController extends Controller
{
    public function deleteAction($recipeId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recipe);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gastro_recipe_book'));
    }

    public function addToMenuAction($recipeId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();

            $recipe->setIsInMenu(true);
            $em->persist($recipe);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gastro_recipe_book'));
    }

    public function removeFromMenuAction($recipeId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();

            $recipe->setIsInMenu(false);
            $em->persist($recipe);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gastro_recipe_book'));
    }
} 