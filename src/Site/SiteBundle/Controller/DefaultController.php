<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteSiteBundle:Default:index.html.twig');
    }

    public function suscribeEmailAction($email)
    {
        $mailChimp = $this->get('MailChimp');

        /**
         * Change mailing list
         * */
        $mailChimp->setListID(175181);

        /**
         * Get list methods
         * */
        $list = $mailChimp->getList();

        /**
         * listSubscribe default Parameters
         * */
        $list->setEmailType('html'); //optional default: html
        $list->setDoubleOptin(true);  //optional default : true
        $list->setUpdateExisting(false); // optional default : false
        $list->setReplaceInterests(true);  // optional default : true
        $list->SendWelcome(false);  // optional default : false

        /**
         * Subscribe user to list
         * */
        $list->Subscribe($email); //boolean

        return $this->redirect($this->generateUrl('_index'));
    }
}
