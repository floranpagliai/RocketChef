<?php

namespace RocketChef\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $restaurant = $this->getUser()->getRestaurant();
        $widgetService = $this->get('widget.generator');
        $recipeProvider = $this->get('rocketchef_data.recipe.provider');
        $translator = $this->get('translator');

        $widgetService->addWidget(array(
            'link'       => 'rocketchef_recipe_book',
            'name'       => $translator->trans('recipebook.recipe.words'),
            'value'      => $recipeProvider->getRestaurantRecipesCount($restaurant->getId()),
            'color'      => 'blue',
            'textcolor'  => 'text-faded',
            'icon'       => 'fa-cutlery',
            'footerText' => $translator->trans('term.see')));
        $widgetService->addWidget(array(
            'link'       => 'rocketchef_menu',
            'name'       => $translator->trans('menu.recipeInMenu'),
            'value'      => $recipeProvider->getRestaurantMenuRecipesCount($restaurant->getId()),
            'color'      => 'blue',
            'textcolor'  => 'text-faded',
            'icon'       => 'fa-columns',
            'footerText' => $translator->trans('term.see')));
        $widgetService->addWidget(array(
            'name'       => $translator->trans('term.cost.average'),
            'value'      => round($recipeProvider->getRestaurantAveragePortionCost($restaurant->getId()), 2) . ' €',
            'color'      => 'blue',
            'textcolor'  => 'text-faded',
            'icon'       => 'fa-money',
            'footerText' => $translator->trans('term.cost.perportion')));

        $widgets = $widgetService->getWidgets();

        $paramsRender = array('widgets' => $widgets);

        return $this->render('RocketChefDashboardBundle:Default:index.html.twig', $paramsRender);
    }
}
