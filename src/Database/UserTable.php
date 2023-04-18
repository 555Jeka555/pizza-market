<?php

namespace App\Database;

use App\Model\Pizza;
use App\Model\User;

class UserTable 
{
    private const MYSQL_DATETIME_FORMAT = "Y-m-d H:i:s";
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findUser(int $userId): ?User
    {
        $query = <<< SQL
            SELECT
                user_id, first_name, second_name, email, phone, avatar_path
            FROM user
            WHERE user_id = $userId
        SQL;
    
        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            return $this->createUserFromRow($row);
        }

        return null;
    }

    public function saveUser(User $user): int
    {
        $query = <<< SQL
            INSERT INTO user (first_name, second_name, email, phone, avatar_path)
            VALUES (:first_name, :second_name, :email, :phone, :avatar_path)
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ":first_name" => $user->getFirstName(), 
            ":second_name" => $user->getSecondName(),
            ":email" => $user->getEmail(),
            ":phone" => $user->getPhone(), 
            ":avatar_path" => $user->getAvatarPath()
        ]);

        return (int)$this->connection->lastInsertId();
    }

    public function getAllPizzas(): array
    {
        $pizzas = [];
        $query = <<< SQL
            SELECT
                pizza_id, title, subtitle, price, last_price, pizza_img_path
            FROM pizza
        SQL;
    
        $statement = $this->connection->query($query);
        if ($rows = $statement->fetchAll(\PDO::FETCH_ASSOC))
        {
            foreach ($rows as $row)
            {
                $pizza = $this->createPizzaFromRow($row);
                array_push($pizzas, $pizza);
            }
        }

        return $pizzas;
    }

    private function createUserFromRow(array $row): User
    {
        return new User(
            (int)$row["user_id"], $row["first_name"], $row["second_name"],
            $row["email"], $row["phone"], $row["avatar_path"]
        );
    }

    private function createPizzaFromRow(array $row): Pizza
    {
        return new Pizza(
            (int)$row["pizza_id"], $row["title"], $row["subtitle"],
            $row["price"], $row["last_price"], $row["pizza_img_path"]
        );
    }

}