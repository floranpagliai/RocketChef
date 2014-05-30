<?php

namespace Gastro\RecipeBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $recipes = $this->container->get('security.context')->getToken()->getUser()->getRecipes();

        $paramsRender = array('recipes' => $recipes);
//        $flash = $this->get('braincrafted_bootstrap.flash');
//        $flash->alert('This is an alert flash message.');
        return $this->render('GastroRecipeBookBundle:Recipe:list.html.twig', $paramsRender);
    }

    public function showAction($recipeId)
    {
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($recipe && $recipe->getUser() == $user)
            $paramsRender = array('recipe' => $recipe);
        else
            throw $this->createNotFoundException('Recette introuvable');

        return $this->render('GastroRecipeBookBundle:Recipe:show.html.twig', $paramsRender);
    }
}
