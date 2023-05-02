<?php

declare(strict_types=1);

namespace App\Entity;

class Pizza
{
    private ?int $pizza_id;
    private string $title;
    private string $subtitle;
    private int $price;
    private int|null $last_price;
    private string|null $pizza_img_path;

    public function __construct(?int $pizza_id, string $title, string $subtitle,
        int $price, int|null $last_price, string|null $pizza_img_path) 
    {
        $this->pizza_id = $pizza_id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->price = $price;
        $this->last_price = $last_price;
        $this->pizza_img_path = $pizza_img_path;
    }

    public function getPizzaId(): ?int
    {
        return $this->pizza_id;
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
        return $this->last_price;
    }

    public function getPizzaImgPath(): string|null
    {
        return $this->pizza_img_path;
    }

}