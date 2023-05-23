<?php

declare(strict_types=1);
namespace App\Service\Data;

class PizzaData
{
    public function __construct(
        private ?int $pizzaId,
        private string $title, 
        private string $subtitle,
        private int $price, 
        private int|null $lastPrice, 
        private string|null $pizzaImgPath) 
    {}

    public function getPizzaId(): ?int
    {
        return $this->pizzaId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubTitle(): string
    {
        return $this->subtitle;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getLastPrice(): int|null
    {
        return $this->lastPrice;
    }

    public function getPizzaImgPath(): string|null
    {
        return $this->pizzaImgPath;
    }
}