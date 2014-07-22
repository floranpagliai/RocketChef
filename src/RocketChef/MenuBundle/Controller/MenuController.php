<?php
/**
 * PageController.php
 * User: Utilisateur
 * Date: 06/06/14
 * Time: 13:53
 */

namespace RocketChef\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        $restaurant = $this->getUser()->getRestaurant();
        $recipes = $this->get('rocketchef_data.recipe.provider')->getAllRestaurantMenuRecipes($restaurant->getId());

        $paramsRender = array('recipes' => $recipes);

        return $this->render('RocketChefMenuBundle:Menu:list.html.twig', $paramsRender);
    }

} 