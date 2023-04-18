<?php

declare(strict_types=1);

namespace App\Model;

class Pizza
{
    private ?int $pizzaId;
    private string $title;
    private string $subtitle;
    private int $price;
    private int|null $lastPrice;
    private string $pizzaImgPath;

    public function __construct(?int $pizzaId, string $title, string $subtitle,
        int $price, int|null $lastPrice, string $pizzaImgPath) 
    {
        $this->pizzaId = $pizzaId;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->price = $price;
        $this->lastPrice = $lastPrice;
        $this->pizzaImgPath = $pizzaImgPath;
    }

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

    public function getPizzaImgPath(): string
    {
        return $this->pizzaImgPath;
    }

}