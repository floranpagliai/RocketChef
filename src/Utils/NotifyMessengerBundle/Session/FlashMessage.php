<?php
/**
 * FlashMessage.php
 * User: floran.pagliai
 * Date: 20/06/14
 * Time: 14:32
 */

namespace Utils\NotifyMessengerBundle\Session;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FlashMessage
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function info($message)
    {
        $this->session->getFlashBag()->add('info', $message);
    }

} 