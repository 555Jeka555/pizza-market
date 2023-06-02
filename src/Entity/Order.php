<?php

declare(strict_types=1);
namespace App\Entity;

class Order
{
    public function __construct(
        private ?int $orderId,
        private ?int $userId,
        private ?int $pizzaId,
        private string $adress, 
        private int $numberCard,
        private int $numberBackCard, 
        private int $dateCard, 
        private \DateTimeImmutable $date) 
    {}

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getNumberCard(): int
    {
        return $this->numberCard;
    }

    public function getNumberBackCard(): int
    {
        return $this->numberBackCard;
    }

    public function getDateCard(): int
    {
        return $this->dateCard;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}