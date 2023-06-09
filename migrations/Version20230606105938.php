<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606105938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Add table order";
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<< SQL
            CREATE TABLE order_pizza (
                order_id INT UNSIGNED AUTO_INCREMENT,
                user_id INT(200) NOT NULL,
                pizza_id INT(200) NOT NULL,
                adress VARCHAR(200) NOT NULL,
                number_card DECIMAL(200) NOT NULL,
                number_back_card INT(200) NOT NULL,
                date_card INT(200) NOT NULL,
                order_date DATETIME NOT NULL,
                PRIMARY KEY (order_id)
            );
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<< SQL
            DROP TABLE order;
        SQL
        );
    }
}
