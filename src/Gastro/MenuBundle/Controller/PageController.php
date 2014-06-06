<?php
/**
 * PageController.php
 * User: Utilisateur
 * Date: 06/06/14
 * Time: 13:53
 */

namespace Gastro\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $recipes = $this->get('gastro_data.recipe.provider')->getAllUserMenuRecipes($user->getId());

        $paramsRender = array('recipes' => $recipes);

        return $this->render('GastroMenuBundle:Menu:list.html.twig', $paramsRender);
    }

} 