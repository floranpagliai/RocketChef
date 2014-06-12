<?php
/**
 * SettingController.php
 * User: Utilisateur
 * Date: 11/06/14
 * Time: 11:38
 */

namespace Gastro\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingController extends Controller
{
    public function indexAction()
    {
        return $this->render('GastroSettingBundle:setting:setting.html.twig');
    }
}
