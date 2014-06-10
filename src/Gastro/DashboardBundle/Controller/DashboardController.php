<?php

namespace Gastro\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $restaurant = $this->container->get('security.context')->getToken()->getUser()->getRestaurant();
        $widgetService = $this->get('widget.generator');
        $recipeProvider = $this->get('gastro_data.recipe.provider');
        $translator = $this->get('translator');

        $widgetService->addWidget(array(
            'link' => 'gastro_recipe_book',
            'name' => $translator->trans('recipebook.recipe.words'),
            'value' => $recipeProvider->getRestaurantRecipesCount($restaurant->getId()),
            'color' => 'blue',
            'textcolor' => 'text-faded',
            'icon' =>'fa-cutlery',
            'footerText' => $translator->trans('term.see')));
        $widgetService->addWidget(array(
            'link' => 'gastro_menu',
            'name' => $translator->trans('menu.recipeInMenu'),
            'value' => $recipeProvider->getRestaurantMenuRecipesCount($restaurant->getId()),
            'color' => 'blue',
            'textcolor' => 'text-faded',
            'icon' =>'fa-columns',
            'footerText' => $translator->trans('term.see')));
        $widgetService->addWidget(array(
            'name' => $translator->trans('term.cost.average'),
            'value' =>  round($recipeProvider->getRestaurantAverageCost($restaurant->getId()), 2) . ' €',
            'color' => 'blue',
            'textcolor' => 'text-faded',
            'icon' => 'fa-money',
            'footerText' => $translator->trans('term.cost.perportion')));

        $widgets = $widgetService->getWidgets();

        $paramsRender = array('widgets' => $widgets);

        return $this->render('GastroDashboardBundle:Default:index.html.twig', $paramsRender);
    }
}
