<?php

namespace Gastro\RecipeBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Gastro\DataBundle\Entity\Recipe;

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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipe = $this->get('gastro_data.recipe.provider')->getRecipeById($recipeId);

        if ($recipe && $recipe->getUser() == $user) {
            $recipeIngredients = $recipe->getRecipeIngredients();
            $cost = $this->get('gastro_data.recipe.provider')->calculateCost($recipe);
            $paramsRender = array(
                'recipe' => $recipe,
                'recipeIngredients' => $recipeIngredients,
                'cost' => $cost);
        } else
            throw $this->createNotFoundException('Recette introuvable');

        return $this->render('GastroRecipeBookBundle:Recipe:show.html.twig', $paramsRender);
    }

    public function addAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $recipe = new Recipe();
        $form = $this->createFormBuilder($recipe)
            ->add('name', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $recipe = $form->getData();
            $recipe->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->redirect($this->generateUrl('gastro_recipe_book_show', array('recipeId'=> $recipe->getId(), 'recipeName'=> $recipe->getName())));
        }

        $paramsRender = array('form' => $form->createView());
        return $this->render('GastroRecipeBookBundle:Recipe:add.html.twig', $paramsRender);
    }

    public function editAction(Request $request, $recipeId)
    {

    }

    public function deleteAction(Request $request, $recipeId)
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
}
