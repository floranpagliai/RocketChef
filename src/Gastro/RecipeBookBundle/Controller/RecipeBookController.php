<?php

namespace Gastro\RecipeBookBundle\Controller;

use Gastro\DataBundle\Entity\Recipe;
use Gastro\RecipeBookBundle\Form\Type\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RecipeBookController extends Controller
{
    public function indexAction()
    {
        $recipes = $this->container->get('security.context')->getToken()->getUser()->getRestaurant()->getRecipes();

        foreach ($recipes as $recipe)
            $this->updateRecipeCost($recipe);

        $paramsRender = array('recipes' => $recipes);

        return $this->render('GastroRecipeBookBundle:Recipe:list.html.twig', $paramsRender);
    }

    public function showAction($recipeId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getRestaurant() == $restaurant) {
            $recipeIngredients = $recipe->getRecipeIngredient();
            $this->updateRecipeCost($recipe);
            if ($recipe->getCost() > 0) {
                $margin = ($recipe->getPrice()-($recipe->getCost()/$recipe->getPortions()))/($recipe->getPrice())*100;
                $ratio = $recipe->getPrice()/($recipe->getCost()/$recipe->getPortions());
            } else {
                $margin = 100;
                $ratio = 0;
            }
            if ($margin > 40)
                $marginColor = 'green';
            else
                $marginColor = 'red';
            $paramsRender = array(
                'recipe' => $recipe,
                'recipeIngredients' => $recipeIngredients,
                'margin' => $margin,
                'minimalPrice' => round(($recipe->getCost()/$recipe->getPortions())*3, 2),
                'portionCost' => $recipe->getCost()/$recipe->getPortions(),
                'ratio' => $ratio,
                'marginColor' => $marginColor
            );
        } else
            throw $this->createNotFoundException('Recette introuvable');

        return $this->render('GastroRecipeBookBundle:Recipe:show.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(new RecipeType($this->container->get('security.context')), $recipe);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $recipe = $form->getData();
                $this->updateRecipe($recipe);

                return $this->redirect($this->generateUrl('gastro_recipe_book_show', array('recipeId'=> $recipe->getId(), 'recipeName' => $recipe->getName())));
            }
        }

        $paramsRender = array('form' => $form->createView());
        return $this->render('GastroRecipeBookBundle:Recipe:add.html.twig', $paramsRender);
    }

    public function editAction(Request $request, $recipeId)
    {
        $recipeOld = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);;
        $form = $this->createForm(new RecipeType($this->container->get('security.context')), $recipeOld);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $recipe = $form->getData();
                $this->updateRecipe($recipe);

                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->alert('Recipe saved');

                return $this->redirect($this->generateUrl('gastro_recipe_book_show', array('recipeId'=> $recipe->getId(), 'recipeName' => $recipe->getName())));
            }
        }

        $paramsRender = array('form' => $form->createView(),
                                'recipe' => $recipeOld);
        return $this->render('GastroRecipeBookBundle:Recipe:edit.html.twig', $paramsRender);

    }

    public function updateRecipe(Recipe $recipe)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();

        $recipe->setRestaurant($restaurant);
        foreach ($recipe->getRecipeIngredient() as $recipeIngredient)
            $recipeIngredient->getIngredient()->setRestaurant($restaurant);

        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();
    }

    public function updateRecipeCost(Recipe $recipe)
    {
        $recipeService = $this->get('gastro_data.recipe.provider');

        $recipe->setCost($recipeService->calculateRecipeCost($recipe));
        foreach ($recipe->getRecipeIngredient() as $recipeIngredient) {
            $recipeIngredient->setCost($recipeService->calculateRecipeIngredientCost($recipeIngredient));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();
    }

}
