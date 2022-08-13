<?php

namespace App\Subscriber;


use App\Model\TimeLoggerInterface;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimeLoggerSubscriber implements EventSubscriberInterface
{

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('persist', $args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof TimeLoggerInterface) {
            return;
        }
        if ($action == 'persist') {
            $entity->setCreatedAt(new \DateTimeImmutable());
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }
        if ($action == 'update') {
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }

    }
}