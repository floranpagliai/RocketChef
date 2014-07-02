<?php

namespace Site\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteSiteBundle:Default:index.html.twig');
    }

    public function subscribeEmailAction($request)
    {
        $form = $this->createFormBuilder()
            ->add('email', 'email')
            ->getForm();
        $error = null;

        $form->submit($request);
        if ($form->isValid()) {
            $email = $form->getData();
            $email = $email['email'];

            $mailChimp = $this->get('MailChimp');
            /**
             * Get list methods
             * */
            $list = $mailChimp->getList();
            /**
             * listSubscribe default Parameters
             * */
            $list->setEmailType('html'); //optional default: html
            $list->setDoubleOptin(false);  //optional default : true
            $list->setUpdateExisting(false); // optional default : false
            $list->setReplaceInterests(true);  // optional default : true
            $list->SendWelcome(false);  // optional default : false

            $ret = $list->Subscribe($email);
            if (isset($ret->error))
            {
                $error = $ret->error;
            }
        }
        $paramsRender = array('form' => $form->createView(), 'error' => $error);
        return $this->render('SiteSiteBundle:Default:subscribe.html.twig', $paramsRender);
    }
}
