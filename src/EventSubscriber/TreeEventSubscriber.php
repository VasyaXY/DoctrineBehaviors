<?php

namespace VasyaXY\DoctrineBehaviors\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use VasyaXY\DoctrineBehaviors\Contract\Entity\TreeNodeInterface;

#[AsDoctrineListener(event: Events::loadClassMetadata, priority: 500, connection: 'default')]
final class TreeEventSubscriber // implements EventSubscriberInterface
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();
        if ($classMetadata->reflClass === null) {
            // Class has not yet been fully built, ignore this event
            return;
        }

        if (! is_a($classMetadata->reflClass->getName(), TreeNodeInterface::class, true)) {
            return;
        }

        if ($classMetadata->hasField('materializedPath')) {
            return;
        }

        $classMetadata->mapField([
            'fieldName' => 'materializedPath',
            'type' => 'string',
            'length' => 255,
        ]);
    }

    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [Events::loadClassMetadata];
    }
}
