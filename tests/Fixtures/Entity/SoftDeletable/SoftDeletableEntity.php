<?php

namespace VasyaXY\DoctrineBehaviors\Tests\Fixtures\Entity\SoftDeletable;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use VasyaXY\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
use VasyaXY\DoctrineBehaviors\Model\SoftDeletable\SoftDeletableTrait;

#[Entity]
#[InheritanceType(value: 'SINGLE_TABLE')]
#[DiscriminatorMap(value: [
    'mainclass' => \VasyaXY\DoctrineBehaviors\Tests\Fixtures\Entity\SoftDeletable\SoftDeletableEntity::class,
    'subclass' => SoftDeletableEntityInherit::class,
])]
class SoftDeletableEntity implements SoftDeletableInterface
{
    use SoftDeletableTrait;

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
