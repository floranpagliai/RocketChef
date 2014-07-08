<?php

namespace RocketChef\UserBundle\Controller;

use RocketChef\UserBundle\Entity\User;
use RocketChef\UserBundle\Form\Type\UserPasswordType;
use RocketChef\UserBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER'))
            return $this->redirect($this->generateUrl('rocketchef_dashboard'));
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render('RocketChefUserBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error,
            'newUserAllowed' => $this->container->getParameter('security.new_user_allowed')
        ));
    }

    public function registerAction(Request $request)
    {
        if (!$this->container->getParameter('security.new_user_allowed'))
            return $this->redirect($this->generateUrl('rocketchef_user_login'));

        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $errors = null;

        if ($request->isMethod('post')) {
            $form->submit($request);
            $validator = $this->get('validator');
            $errors = $validator->validate($user);
            if ($form->isValid()) {
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $user->setPassword($encoder->encodePassword($user->getPassword(), null));

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->success($this->get('translator')->trans('user.warn.can_login'));
                return $this->redirect($this->generateUrl('rocketchef_user_login'));
            }
        }
        $paramsRender = array('form' => $form->createView(), 'errors' => $errors);
        return $this->render('RocketChefUserBundle:Security:register.html.twig', $paramsRender);
    }

    public function editPassAction($request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $form = $this->createForm(new UserPasswordType(), $user);
        $form->add('oldPassword', 'password', array('mapped' => false));

        $form->submit($request);
        if ($form->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPassword(), null));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $flash = $this->get('notify_messenger.flash');
            $flash->info($this->get('translator')->trans('user.warn.password_updated'));
        }

        $paramsRender = array('form' => $form->createView());
        return $this->render('RocketChefUserBundle:Security:editpassform.html.twig', $paramsRender);
    }

    public function loginCheckAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
