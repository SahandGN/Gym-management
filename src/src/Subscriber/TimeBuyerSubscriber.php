<?php
//
//namespace App\Subscriber;
//
//use App\Model\TimeBuyerInterface;
//use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
//use Doctrine\ORM\Events;
//use Doctrine\Persistence\Event\LifecycleEventArgs;
//
//
//class TimeBuyerSubscriber implements EventSubscriberInterface
//{
//    public function getSubscribedEvents(): array
//    {
//        return [
//            Events::preUpdate,
//        ];
//    }
//
//    public function preUpdate(LifecycleEventArgs $args): void
//    {
//        $this->buyActivity($args);
//    }
//
//    private function buyActivity(LifecycleEventArgs $args): void
//    {
//        $entity = $args->getObject();
//
//        if (!$entity instanceof TimeBuyerInterface) {
//            return;
//        }
//            $entity->setShoppedAt(new \DateTimeImmutable());
//
//    }
//}