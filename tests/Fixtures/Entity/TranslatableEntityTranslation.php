<?php

namespace VasyaXY\DoctrineBehaviors\Tests\Fixtures\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use VasyaXY\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use VasyaXY\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[Entity]
class TranslatableEntityTranslation implements TranslationInterface
{
    use TranslationTrait;

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string')]
    private ?string $title = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
