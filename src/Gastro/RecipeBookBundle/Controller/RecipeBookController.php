<?php

namespace Gastro\RecipeBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Gastro\DataBundle\Entity\Recipe;
use Gastro\RecipeBookBundle\Form\Type\RecipeType;

class RecipeBookController extends Controller
{
    public function indexAction()
    {
        $recipes = $this->container->get('security.context')->getToken()->getUser()->getRestaurant()->getRecipes();

        foreach ($recipes as $recipe)
        {
            $this->updateRecipe($recipe);
        }

        $paramsRender = array('recipes' => $recipes);

        return $this->render('GastroRecipeBookBundle:Recipe:list.html.twig', $paramsRender);
    }

    public function showAction($recipeId)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getRestaurant() == $restaurant) {
            $recipeIngredients = $recipe->getRecipeIngredient();
            $this->updateRecipe($recipe);
            if ($recipe->getCost() > 0)
                $margin = (($recipe->getPrice()-($recipe->getCost()/$recipe->getPortions()))/$recipe->getCost()) * 100;
            else
                $margin = 0;
            $paramsRender = array(
                'recipe' => $recipe,
                'recipeIngredients' => $recipeIngredients,
                'margin' => $margin);
        } else
            throw $this->createNotFoundException('Recette introuvable');

        return $this->render('GastroRecipeBookBundle:Recipe:show.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();

        $recipe = new Recipe();
        $form = $this->createForm(new RecipeType(), $recipe);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $recipe = $form->getData();
                $this->updateRecipe($recipe);
                $recipe->setRestaurant($restaurant);

                $em = $this->getDoctrine()->getManager();
                $em->persist($recipe);
                $em->flush();

                return $this->redirect($this->generateUrl('gastro_recipe_book_show', array('recipeId'=> $recipe->getId(), 'recipeName' => $recipe->getName())));
            }
        }

        $paramsRender = array('form' => $form->createView());
        return $this->render('GastroRecipeBookBundle:Recipe:add.html.twig', $paramsRender);
    }

    public function editAction(Request $request, $recipeId)
    {
        $em = $this->getDoctrine()->getManager();

        $recipeOld = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);;
        $form = $this->createForm(new RecipeType(), $recipeOld);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $recipe = $form->getData();
                $this->updateRecipe($recipe);

                $em->persist($recipe);
                $em->flush();

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
        $recipeService = $this->get('gastro_data.recipe.provider');

        $recipe->setCost($recipeService->calculateRecipeCost($recipe));
        foreach ($recipe->getRecipeIngredient() as $recipeIngredient)
            $recipeIngredient->setCost($recipeService->calculateRecipeIngredientCost($recipeIngredient));

        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();
    }

}
