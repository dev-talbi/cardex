<?php

namespace App\EventListener;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener implements EventSubscriberInterface
{
    public function __construct(public EntityManagerInterface $em, public UserPasswordHasherInterface $encoder)
    {

    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['passwordEncoder', EventPriorities::PRE_WRITE],
        ];
    }

    public function passwordEncoder(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST  !== $method) {
            return;
        }

        $hash = $this->encoder->hashPassword($user, $user->getPassword());
        $user->setPassword($hash);

    }


}
