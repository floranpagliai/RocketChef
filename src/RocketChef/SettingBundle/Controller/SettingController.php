<?php
/**
 * SettingController.php
 * User: Utilisateur
 * Date: 11/06/14
 * Time: 11:38
 */

namespace RocketChef\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingController extends Controller
{
    public function indexAction()
    {
        return $this->render('RocketChefSettingBundle:setting:setting.html.twig');
    }
}
