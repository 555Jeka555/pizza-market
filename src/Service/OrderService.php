<?php

declare(strict_types=1);
namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Service\Data\OrderData;
use App\Service\Data\PizzaData;
use App\Service\Data\UserData;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;

class OrderService implements OrderServiceIntarface 
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function saveOrder(UserData $user, PizzaData $pizza, Request $request): int
    {
        $order = new Order(
            null, 
            $user->getUserId(),
            $pizza->getPizzaId(),
            $request->get("adress"),
            (int)$request->get("number_card"),
            (int)$request->get("number_back_card"),
            (int)$request->get("date_card"),
            new DateTimeImmutable(),
        );
        return $this->orderRepository->store($order);
    }
   
    public function getOrder(int $orderId): ?OrderData
    {
        $order = $this->orderRepository->findById($orderId);
        if ($order === null) 
        {
            return null;
        }
        return new OrderData (
            $order->getOrderId(),
            $order->getUserId(),
            $order->getPizzaId(),
            $order->getAdress(),
            $order->getNumberCard(),
            $order->getNumberBackCard(),
            $order->getDateCard(),
            $order->getDate(),
        );
    }

    public function deleteOrder(int $orderId): void
    {}

    public function listOrders(): array
    {
        return $this->orderRepository->listAll();
    }
}