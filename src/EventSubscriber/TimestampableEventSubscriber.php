<?php

namespace VasyaXY\DoctrineBehaviors\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use VasyaXY\DoctrineBehaviors\Contract\Entity\TimestampableInterface;

#[AsDoctrineListener(event: Events::loadClassMetadata, priority: 500, connection: 'default')]
final class TimestampableEventSubscriber // implements EventSubscriberInterface
{
    public function __construct(
        private string $timestampableDateFieldType
    ) {
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();
        if ($classMetadata->reflClass === null) {
            // Class has not yet been fully built, ignore this event
            return;
        }

        if (! is_a($classMetadata->reflClass->getName(), TimestampableInterface::class, true)) {
            return;
        }

        if ($classMetadata->isMappedSuperclass) {
            return;
        }

        $classMetadata->addLifecycleCallback('updateTimestamps', Events::prePersist);
        $classMetadata->addLifecycleCallback('updateTimestamps', Events::preUpdate);

        foreach (['createdAt', 'updatedAt'] as $field) {
            if (! $classMetadata->hasField($field)) {
                $classMetadata->mapField([
                    'fieldName' => $field,
                    'type' => $this->timestampableDateFieldType,
                    'nullable' => true,
                ]);
            }
        }
    }

    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [Events::loadClassMetadata];
    }
}
