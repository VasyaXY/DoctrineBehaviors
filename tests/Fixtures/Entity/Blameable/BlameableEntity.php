<?php

namespace VasyaXY\DoctrineBehaviors\Tests\Fixtures\Entity\Blameable;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use VasyaXY\DoctrineBehaviors\Contract\Entity\BlameableInterface;
use VasyaXY\DoctrineBehaviors\Exception\ShouldNotHappenException;
use VasyaXY\DoctrineBehaviors\Model\Blameable\BlameableTrait;

#[Entity]
class BlameableEntity implements BlameableInterface
{
    use BlameableTrait;

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string', nullable: true)]
    private ?string $title = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        if ($this->title === null) {
            throw new ShouldNotHappenException();
        }

        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
