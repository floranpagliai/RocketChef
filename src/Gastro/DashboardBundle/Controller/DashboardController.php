<?php

namespace Gastro\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $widgetService = $this->get('widget.generator');
        $recipeProvider = $this->get('gastro_data.recipe.provider');

        $widgetService->addWidget(array(
            'link' => 'gastro_recipe_book',
            'name' => 'Recipes',
            'value' => $recipeProvider->getUserRecipesCount($user->getId()),
            'color' => 'blue',
            'textcolor' => 'text-faded',
            'icon' =>'fa-cutlery'));
        $widgetService->addWidget(array(
            'name' => 'Average cost',
            'value' => 2 . ' €',
            'color' => 'blue',
            'textcolor' => 'text-faded',
            'icon' => 'fa-money'));
        $widgets = $widgetService->getWidgets();

        $paramsRender = array('widgets' => $widgets);

        return $this->render('GastroDashboardBundle:Default:index.html.twig', $paramsRender);
    }
}
