<?php

namespace Gastro\UserBundle\Controller;

use Gastro\UserBundle\Entity\User;
use Gastro\UserBundle\Form\Type\UserPasswordType;
use Gastro\UserBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER'))
            return $this->redirect($this->generateUrl('gastro_dashboard'));
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

        return $this->render('GastroUserBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error,
            'newUserAllowed' => $this->container->getParameter('security.new_user_allowed')
        ));
    }

    public function registerAction(Request $request)
    {
        if (!$this->container->getParameter('security.new_user_allowed'))
            return $this->redirect($this->generateUrl('gastro_user_login'));

        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $errors = null;

        if ($request->isMethod('post')) {
            $form->submit($request);
            $validator = $this->get('validator');
            $errors = $validator->validate($user);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->success('Utilisateur enregistré. Vous pouvez maintenant vous connecter.');
                return $this->redirect($this->generateUrl('gastro_user_login'));
            }
        }
        $paramsRender = array('form' => $form->createView(), 'errors' => $errors);
        return $this->render('GastroUserBundle:Security:register.html.twig', $paramsRender);
    }

    public function editPassAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $form = $this->createForm(new UserPasswordType(), $user, array(
            'action' => $this->generateUrl('gastro_user_change_pass')));

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->success('Mot de passe changé');
                return $this->redirect($request->headers->get('referer'));
            }

        $paramsRender = array('form' => $form->createView());
        return $this->render('GastroUserBundle:Security:editpassform.html.twig', $paramsRender);
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
