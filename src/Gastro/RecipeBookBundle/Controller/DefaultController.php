<?php

namespace Gastro\RecipeBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $recipes = $this->get('gastro_data.recipe.provider')->getAllRecipes();
        $flash = $this->get('braincrafted_bootstrap.flash');
        $flash->alert('This is an alert flash message.');
        return $this->render('GastroRecipeBookBundle:Recipe:list.html.twig', array('recipes' => $recipes));
    }
}
