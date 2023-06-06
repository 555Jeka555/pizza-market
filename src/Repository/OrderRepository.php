<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class OrderRepository
{
    private EntityManagerInterface $entityManeger;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManeger = $entityManager;
        $this->repository = $entityManager->getRepository(Order::class);
    }

    public function findById(int $id): ?Order
    {
        $order = $this->repository->findOneBy(["orderId" => (string) $id]);
        if ($order !== null) 
        {
            return new Order(
                $order->getOrderId(),
                $order->getUserId(),
                $order->getPizzaId(),
                $order->getAdress(),
                $order->getNumberCard(),
                $order->getNumberBackCard(),
                $order->getDateCard(),
                $order->getDate()
            );
        }
    }

    public function store(Order $order): int
    {
        $this->entityManeger->persist($order);
        $this->entityManeger->flush();
        return $order->getOrderId();
    }

    public function delete(Order $order): void
    {
        $this->entityManeger->remove($order);
        $this->entityManeger->flush();
    }

    public function listAll(): array
    {
        return $this->repository->findAll();
    }

}