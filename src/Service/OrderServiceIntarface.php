<?php

declare(strict_types=1);
namespace App\Service;

use App\Service\Data\OrderData;
use App\Service\Data\UserData;
use App\Service\Data\PizzaData;
use Symfony\Component\HttpFoundation\Request;

interface OrderServiceIntarface
{
    public function saveOrder(UserData $user, PizzaData $pizza, Request $request): int;
   
    public function getOrder(int $orderId): ?OrderData;

    public function deleteOrder(int $orderId): void;

    public function listOrders(): array;
}
