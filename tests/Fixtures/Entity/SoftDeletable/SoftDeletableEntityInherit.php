<?php

namespace VasyaXY\DoctrineBehaviors\Tests\Fixtures\Entity\SoftDeletable;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class SoftDeletableEntityInherit extends SoftDeletableEntity
{
    #[Column(type: 'string')]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
}
